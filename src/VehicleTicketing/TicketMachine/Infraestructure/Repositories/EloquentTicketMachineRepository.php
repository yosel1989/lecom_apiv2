<?php


namespace Src\VehicleTicketing\TicketMachine\Infraestructure\Repositories;


use App\Models\VehicleTicketing\TicketMachine as EloquentTicketMachineModel;
use Src\Admin\User\Domain\User;
use Src\Admin\Vehicle\Domain\Vehicle;
use Src\ModelBase\Domain\ValueObjects\DateFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\VehicleTicketing\TicketMachine\Domain\Contracts\TicketMachineRepositoryContract;
use Src\VehicleTicketing\TicketMachine\Domain\TicketMachine;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineDeleted;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineId;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineIdClient;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineIdVehicle;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineImei;

final class EloquentTicketMachineRepository implements TicketMachineRepositoryContract
{
    /**
     * @var EloquentTicketMachineModel
     */
    private $eloquentTicketMachineModel;

    public function __construct()
    {
        $this->eloquentTicketMachineModel = new EloquentTicketMachineModel;
    }

    public function find(TicketMachineId $id): ?TicketMachine
    {

        $ticketMachine = $this->eloquentTicketMachineModel->findOrFail($id->value());

        // Return Domain Ticket Machine model
        return new TicketMachine(
            new TicketMachineId($ticketMachine->id),
            new TicketMachineImei($ticketMachine->imei),
            new TicketMachineDeleted($ticketMachine->deleted),
            new TicketMachineIdClient($ticketMachine->id_client),
            new TicketMachineIdVehicle($ticketMachine->id_vehicle)
        );

    }

    public function findByImei( TicketMachineImei $imei ): ?TicketMachine
    {
        $ticketMachine = $this->eloquentTicketMachineModel
            ->where('imei', $imei->value())
            ->firstOrFail();

        // Return Domain Ticket Machine model
        return new TicketMachine(
            new TicketMachineId($ticketMachine->id),
            new TicketMachineImei($ticketMachine->imei),
            new TicketMachineDeleted($ticketMachine->deleted),
            new TicketMachineIdClient($ticketMachine->id_client),
            new TicketMachineIdVehicle($ticketMachine->id_vehicle)
        );
    }

    public function create( Id $id, Text $imei, Id $idClient, Id $idVehicle, Id $idUserCreated ): void{
        $ticketMachine = $this->eloquentTicketMachineModel->create([
            'id' => $id->value(),
            'imei' => $imei->value(),
            'id_client' => $idClient->value(),
            'id_vehicle' => $idVehicle->value(),
            'id_user_created' => $idUserCreated->value()
        ]);
    }

    public function update(Id $id, Text $imei, Id $idClient, Id $idVehicle, Id $idUserUpdated): void{
        $ticketMachine = $this->eloquentTicketMachineModel->findOrFail($id->value())->update([
            'imei' => $imei->value(),
            'id_client' => $idClient->value(),
            'id_vehicle' => $idVehicle->value(),
            'id_user_updated' => $idUserUpdated->value()
        ]);
    }

    public function collectionByClient(Id $idClient): array{
        $collection = [];

        $response = $this->eloquentTicketMachineModel
            ->with('vehicle','userCreated','userUpdated')
            ->where('id_client', $idClient->value())
            ->get();

        foreach( $response as $item) {
            $model = new TicketMachine(
                new TicketMachineId($item->id),
                new TicketMachineImei($item->imei),
                new TicketMachineDeleted($item->deleted),
                new TicketMachineIdClient($item->id_client),
                new TicketMachineIdVehicle($item->id_vehicle)
            );
            $model->setCreatedAt(new DateFormat($item->created_at,true,'El formato de fecha de creación es incorrecta'));
            $model->setUpdatedAt(new DateFormat($item->updated_at,true,'El formato de fecha de modificación es incorrecta'));
            $model->setIdUserCreated(new Id($item->id_user_created,true,'El formato del id del usuario para registrar es incorrecto'));
            $model->setIdUserUpdated(new Id($item->id_user_updated,true,'El formato del id del usuario para modificar es incorrecto'));
            $vehicle = is_null($item->vehicle) ? null : Vehicle::createEntity($item->vehicle);
            $userCreated = is_null($item->userCreated) ? null : User::createEntity($item->userCreated);
            $userUpdated = is_null($item->userUpdated) ? null : User::createEntity($item->userUpdated);
            $model->setVehicle($vehicle);
            $model->setUserCreated($userCreated);
            $model->setUserUpdated($userUpdated);
            $collection[] = $model;
        }

        return $collection;
    }

}
