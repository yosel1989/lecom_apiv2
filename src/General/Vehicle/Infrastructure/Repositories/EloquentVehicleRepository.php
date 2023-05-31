<?php

declare(strict_types=1);

namespace Src\General\Vehicle\Infrastructure\Repositories;

use App\Models\General\Vehicle as EloquentVehicleModel;
use InvalidArgumentException;
use Src\Auth\User\Domain\ValueObjects\UserId;
use Src\General\Vehicle\Domain\Contracts\VehicleRepositoryContract;
use Src\General\Vehicle\Domain\ValueObjects\VehicleDeleted;
use Src\General\Vehicle\Domain\ValueObjects\VehicleId;
use Src\General\Vehicle\Domain\ValueObjects\VehicleIdCategory;
use Src\General\Vehicle\Domain\ValueObjects\VehicleIdClass;
use Src\General\Vehicle\Domain\ValueObjects\VehicleIdClient;
use Src\General\Vehicle\Domain\ValueObjects\VehicleIdModel;
use Src\General\Vehicle\Domain\ValueObjects\VehiclePlate;
use Src\General\Vehicle\Domain\ValueObjects\VehicleUnit;
use Src\General\Vehicle\Domain\Vehicle;

final class EloquentVehicleRepository implements VehicleRepositoryContract
{
    /**
     * @var EloquentVehicleModel
     */
    private $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentVehicleModel = new EloquentVehicleModel;
    }

    public function find(VehicleId $id): ?Vehicle
    {
        $vehicle = $this->eloquentVehicleModel->findOrFail($id->value());
        // Return Domain Ticket model
        return new Vehicle(
            new VehicleId( $vehicle->id ),
            new VehiclePlate( $vehicle->plate ),
            new VehicleUnit( $vehicle->unit ),
            new VehicleDeleted( $vehicle->deleted ),
            new VehicleIdClient( $vehicle->id_client ),
            new VehicleIdCategory( $vehicle->id_category ),
            new VehicleIdModel( $vehicle->id_model ),
            new VehicleIdClass( $vehicle->id_class )
        );

    }

    public function findByPlate(VehiclePlate $plate, VehicleIdClient $idClient): ?Vehicle
    {
        $vehicle = $this->eloquentVehicleModel->where('plate', $plate->value())->where('id_client', $idClient->value())->first();
        // Return Domain Ticket model
        if(!$vehicle){
            throw new InvalidArgumentException( 'El vehiculo no se encuentra registrado en el sistema');
        }
        return new Vehicle(
            new VehicleId( $vehicle->id ),
            new VehiclePlate( $vehicle->plate ),
            new VehicleUnit( $vehicle->unit ),
            new VehicleDeleted( $vehicle->deleted ),
            new VehicleIdClient( $vehicle->id_client ),
            new VehicleIdCategory( $vehicle->id_category ),
            new VehicleIdModel( $vehicle->id_model ),
            new VehicleIdClass( $vehicle->id_class )
        );

    }

    public function getVehiclesByUser(UserId $userId): array
    {
        $vehicles = $this->eloquentVehicleModel
            ->select('vehicles.*')
                        ->join('user_vehicles','vehicles.id','=','user_vehicles.id_vehicle')
                        ->where('user_vehicles.id_user',$userId->value())
                        ->get();

        $arrVehicles = array();

        foreach ( $vehicles as $vehicle ){
            $arrVehicles[] = new Vehicle(
                new VehicleId( $vehicle->id ),
                new VehiclePlate( $vehicle->plate ),
                new VehicleUnit( $vehicle->unit ),
                new VehicleDeleted( $vehicle->deleted ),
                new VehicleIdClient( $vehicle->id_client ),
                new VehicleIdCategory( $vehicle->id_category ),
                new VehicleIdModel( $vehicle->id_model ),
                new VehicleIdClass( $vehicle->id_class )
            );
        }

        return $arrVehicles;
    }

    public function findWithRelations( VehicleId $id, array $relations ): ?Vehicle
    {
        $vehicle = $this->eloquentVehicleModel
            ->with($relations)
            ->findOrFail($id->value());

        // Return Domain Ticket model
        return new Vehicle(
            new VehicleId( $vehicle->id ),
            new VehiclePlate( $vehicle->plate ),
            new VehicleUnit( $vehicle->unit ),
            new VehicleDeleted( $vehicle->deleted ),
            new VehicleIdClient( $vehicle->id_client ),
            new VehicleIdCategory( $vehicle->id_category ),
            new VehicleIdModel( $vehicle->id_model ),
            new VehicleIdClass( $vehicle->id_class )
        );
    }

}
