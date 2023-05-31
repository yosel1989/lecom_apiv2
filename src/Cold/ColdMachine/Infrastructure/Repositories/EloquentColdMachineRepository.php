<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachine\Infrastructure\Repositories;

use App\Models\Cold\ColdMachine as EloquentColdMachineModel;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\User\Domain\ValueObjects\UserId;

use Src\Cold\ColdMachine\Domain\ValueObjects\CMId;
use Src\Cold\ColdMachine\Domain\Contracts\ColdMachineRepositoryContract;
use Src\Cold\ColdMachine\Domain\ColdMachine;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMIdClient;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMIdModel;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMIdStatus;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMImei;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMMaxFuel;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMSetPoint;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMSim;
use Src\Cold\ColdMachineHistory\Domain\ColdMachineHistory;
use Src\Cold\ColdMachineModel\Domain\ColdMachineModel;
use Src\Utility\UDateTime;

final class EloquentColdMachineRepository implements ColdMachineRepositoryContract
{
    /**
     * @var EloquentColdMachineModel
     */
    private $EloquentColdMachineModel;

    public function __construct()
    {
        $this->EloquentColdMachineModel = new EloquentColdMachineModel;
    }

    public function find( CMId $id ): ?ColdMachine
    {
        $response = $this->EloquentColdMachineModel->findOrFail($id->value());
        // Return Domain Ticket model
        $OColdMachine = new ColdMachine(
            new CMId( $response->id ),
            new CMImei( $response->imei ),
            new CMIdModel( $response->id_model ),
            new CMIdStatus( $response->id_status ),
            new CMSetPoint( $response->setPoint ),
            new CMIdClient( $response->id_client ),
            new CMSim( $response->sim ),
            new CMMaxFuel( $response->maxFuel ),
            new UserId( $response->id_user_created ),
            $response->id_user_created ? new UserId( $response->id_user_created ) : null
        );
        $OColdMachine->setDateCreated( new UDateTime($response->created_at));
        $OColdMachine->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
        return $OColdMachine;
    }

    public function findByImei( CMImei $imei ): ?ColdMachine
    {
        $response = $this->EloquentColdMachineModel->with('machineModel')->where('imei',$imei->value())->firstOrFail();
        // Return Domain Ticket model
        $OColdMachine = new ColdMachine(
            new CMId( $response->id ),
            new CMImei( $response->imei ),
            new CMIdModel( $response->id_model ),
            new CMIdStatus( $response->id_status ),
            new CMSetPoint( $response->setPoint ),
            new CMIdClient( $response->id_client ),
            new CMSim( $response->sim ),
            new CMMaxFuel( $response->maxFuel ),
            new UserId( $response->id_user_created ),
            $response->id_user_created ? new UserId( $response->id_user_created ) : null
        );
        $OColdMachine->setModel($response->machineModel ? ColdMachineModel::createEntity($response->machineModel) : null);
        //$OColdMachine->setDateCreated( new UDateTime($response->created_at));
        //$OColdMachine->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
        return $OColdMachine;
    }

    public function create(
        CMId  $id,
        CMImei $imei,
        CMIdModel $idModel,
        CMIdStatus $idStatus,
        CMSetPoint $setPoint,
        CMIdClient $idClient,
        CMMaxFuel $maxFuel,
        CMSim $sim,
        UserId $idUserCreated
    ): ?ColdMachine{
        $today = new \DateTime('now');
        $this->EloquentColdMachineModel->create([
            'id'    => $id->value(),
            'imei'  => $imei->value(),
            'id_model'  => $idModel->value(),
            'setPoint'  => $setPoint->value(),
            'id_status' => $idStatus->value(),
            'id_client' => $idClient->value(),
            'maxFuel' => $maxFuel->value(),
            'sim' => $sim->value(),
            'id_user_created' => $idUserCreated->value(),
            'created_at' => $today->format('Y-m-d H:i:s')
        ]);
        $response = $this->EloquentColdMachineModel->with('machineModel')->findOrFail($id->value());
        // Return Domain Ticket model
        $OColdMachine =  new ColdMachine(
            new CMId( $response->id ),
            new CMImei( $response->imei ),
            new CMIdModel( $response->id_model ),
            new CMIdStatus( $response->id_status ),
            new CMSetPoint( $response->setPoint ),
            new CMIdClient( $response->id_client ),
            new CMSim( $response->sim ),
            new CMMaxFuel( $response->maxFuel ),
            new UserId( $response->id_user_created ),
            $response->id_user_created ? new UserId( $response->id_user_created ) : null
        );
        $OColdMachine->setModel($response->machineModel ? ColdMachineModel::createEntity($response->machineModel) : null);
        $OColdMachine->setDateCreated( new UDateTime($response->created_at));
        $OColdMachine->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
        return $OColdMachine;
    }

    public function update(
        CMId  $id,
        CMImei $imei,
        CMIdModel $idModel,
        CMIdStatus $idStatus,
        CMSetPoint $setPoint,
        CMIdClient $idClient,
        CMMaxFuel $maxFuel,
        CMSim $sim,
        UserId $idUserUpdated
    ): ?ColdMachine
    {
        $today = new \DateTime('now');
        $this->EloquentColdMachineModel->findOrFail($id->value())->update([
            'imei'  => $imei->value(),
            'id_model'  => $idModel->value(),
            'setPoint'  => $setPoint->value(),
            'id_status' => $idStatus->value(),
            'id_client' => $idClient->value(),
            'maxFuel' => $maxFuel->value(),
            'sim' => $sim->value(),
            'id_user_updated' => $idUserUpdated->value(),
            'updated_at' => $today->format('Y-m-d H:i:s')
        ]);
        $response = $this->EloquentColdMachineModel->with('machineModel')->findOrFail($id->value());
        // Return Domain Ticket model
        $OColdMachine = new ColdMachine(
            new CMId( $response->id ),
            new CMImei( $response->imei ),
            new CMIdModel( $response->id_model ),
            new CMIdStatus( $response->id_status ),
            new CMSetPoint( $response->setPoint ),
            new CMIdClient( $response->id_client ),
            new CMSim( $response->sim ),
            new CMMaxFuel( $response->maxFuel ),
            new UserId( $response->id_user_created ),
            $response->id_user_created ? new UserId( $response->id_user_created ) : null
        );
        $OColdMachine->setModel($response->machineModel ? ColdMachineModel::createEntity($response->machineModel) : null);
        $OColdMachine->setDateCreated( new UDateTime($response->created_at));
        $OColdMachine->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
        return $OColdMachine;
    }

    public function trash( CMId $id ): void
    {
        $this->EloquentColdMachineModel->findOrFail($id->value())->delete();
    }

    public function delete( CMId $id ): void
    {
        $this->EloquentColdMachineModel->findOrFail($id->value())->forceDelete();
    }

    public function restore( CMId $id ): void
    {
        $this->EloquentColdMachineModel->withTrashed()->findOrFail($id->value())->restore();
    }

    public function collectionByClient( ClientId $clientId ): array
    {
        $responseArray = $this->EloquentColdMachineModel->with('machineModel')->where('id_client',$clientId->value())->get();
        $collection = array();

        foreach ( $responseArray as $response ){

            $OColdMachine = new ColdMachine(
                new CMId( $response->id ),
                new CMImei( $response->imei ),
                new CMIdModel( $response->id_model ),
                new CMIdStatus( $response->id_status ),
                new CMSetPoint( $response->setPoint ),
                new CMIdClient( $response->id_client ),
                new CMSim( $response->sim ),
                new CMMaxFuel( $response->maxFuel ),
                new UserId( $response->id_user_created ),
                $response->id_user_created ? new UserId( $response->id_user_created ) : null
            );
            $OColdMachine->setDateCreated( new UDateTime($response->created_at));
            $OColdMachine->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
            $OColdMachine->setModel($response->machineModel ? ColdMachineModel::createEntity($response->machineModel) : null);
            $collection[] = $OColdMachine;
        }

        return $collection;
    }

    public function realTimeByClient( ClientId $clientId ): array
    {
        $responseArray = $this->EloquentColdMachineModel->with(['machineModel','realTime'])->get();
        $collection = array();

        foreach ( $responseArray as $response ){

            $OColdMachine = new ColdMachine(
                new CMId( $response->id ),
                new CMImei( $response->imei ),
                new CMIdModel( $response->id_model ),
                new CMIdStatus( $response->id_status ),
                new CMSetPoint( $response->setPoint ),
                new CMIdClient( $response->id_client ),
                new CMSim( $response->sim ),
                new CMMaxFuel( $response->maxFuel ),
                new UserId( $response->id_user_created ),
                $response->id_user_created ? new UserId( $response->id_user_created ) : null
            );
            $OColdMachine->setDateCreated( new UDateTime($response->created_at));
            $OColdMachine->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
            $OColdMachine->setModel($response->machineModel ? ColdMachineModel::createEntity($response->machineModel) : null);
            $OColdMachine->setRealTime($response->realTime ? ColdMachineHistory::createEntity($response->realTime) : null);
            $collection[] = $OColdMachine;
        }

        return $collection;
    }

    public function collection(): array
    {
        $responseArray = $this->EloquentColdMachineModel->with('machineModel')->get();
        $collection = array();

        foreach ( $responseArray as $response ){

            $OColdMachine = new ColdMachine(
                new CMId( $response->id ),
                new CMImei( $response->imei ),
                new CMIdModel( $response->id_model ),
                new CMIdStatus( $response->id_status ),
                new CMSetPoint( $response->setPoint ),
                new CMIdClient( $response->id_client ),
                new CMSim( $response->sim ),
                new CMMaxFuel( $response->maxFuel ),
                new UserId( $response->id_user_created ),
                $response->id_user_created ? new UserId( $response->id_user_created ) : null
            );
            $OColdMachine->setDateCreated( new UDateTime($response->created_at));
            $OColdMachine->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
            $OColdMachine->setModel(ColdMachineModel::createEntity($response->machineModel));
            $collection[] = $OColdMachine;
        }

        return $collection;
    }



    public function collectionTrashed(): array
    {
        $responseArray = $this->EloquentColdMachineModel->onlyTrashed()->all();
        $collection = array();

        foreach ( $responseArray as $response ){
            $OColdMachine = new ColdMachine(
                new CMId( $response->id ),
                new CMImei( $response->imei ),
                new CMIdModel( $response->id_model ),
                new CMIdStatus( $response->id_status ),
                new CMSetPoint( $response->setPoint ),
                new CMIdClient( $response->id_client ),
                new CMSim( $response->sim ),
                new CMMaxFuel( $response->maxFuel ),
                new UserId( $response->id_user_created ),
                $response->id_user_created ? new UserId( $response->id_user_created ) : null
            );
            $OColdMachine->setDateCreated( new UDateTime($response->created_at));
            $OColdMachine->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
            $collection[] = $OColdMachine;
        }

        return $collection;
    }


}
