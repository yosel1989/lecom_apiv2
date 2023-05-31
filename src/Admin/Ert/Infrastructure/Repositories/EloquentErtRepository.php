<?php

declare(strict_types=1);

namespace Src\Admin\Ert\Infrastructure\Repositories;

use App\Models\Admin\Ert as EloquentErtModel;
use Src\Admin\Client\Domain\Client;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Ert\Domain\Contracts\ErtRepositoryContract;

use Src\Admin\Ert\Domain\Ert;
use Src\Admin\Ert\Domain\ValueObjects\ErtId;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdClient;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdGps;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdSim;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdType;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdVehicle;
use Src\Admin\Ert\Domain\ValueObjects\ErtPeriod;
use Src\Admin\Ert\Domain\ValueObjects\ErtSutran;
use Src\Admin\Gps\Domain\Gps;
use Src\Admin\SimCard\Domain\SimCard;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleId;
use Src\Admin\Vehicle\Domain\Vehicle;

final class EloquentErtRepository implements ErtRepositoryContract
{
    /**
     * @var EloquentErtModel
     */
    private $eloquentErtModel;

    public function __construct()
    {
        $this->eloquentErtModel = new EloquentErtModel;
    }

    public function create(
        ErtId $id,
        ErtPeriod $period,
        ErtSutran $sutran,
        ClientId $clientId,
        VehicleId $vehicleId,
        ErtIdType $idType,
        ErtIdGps $idGps,
        ErtIdSim $idSim ): ?Ert
    {
        $this->eloquentErtModel->create([
            'id' => $id->value(),
            'period' => $period->value(),
            'sutran' => $sutran->value(),
            'deleted' => 0,
            'id_client' => $clientId->value(),
            'id_vehicle' => $vehicleId->value(),
            'id_type' => $idType->value(),
            'id_gps' => $idGps->value(),
            'id_sim' => $idSim->value()
        ]);

        $ert = $this->eloquentErtModel->with(['idClient_pk','idVehicle_pk','idSimCard_pk','idGps_pk'])->findOrFail($id->value());

        $OErt = new Ert(
            new ErtId( $ert->id ),
            new ErtPeriod( $ert->period ),
            new ErtSutran( $ert->sutran ),
            new ErtIdClient( $ert->id_client ),
            new ErtIdVehicle( $ert->id_vehicle ),
            new ErtIdType( $ert->id_type ),
            new ErtIdGps( $ert->id_gps ),
            new ErtIdSim( $ert->id_sim )
        );

        $client = is_null($ert->idClient_pk) ? null : Client::createEntity($ert->idClient_pk);
        $vehicle = is_null($ert->idVehicle_pk) ? null : Vehicle::createEntity($ert->idVehicle_pk);
        $simCard = is_null($ert->idSimCard_pk) ? null : SimCard::createEntity($ert->idSimCard_pk);
        $gps = is_null($ert->idGps_pk) ? null : Gps::createEntity($ert->idGps_pk);

        $OErt->setClient($client);
        $OErt->setVehicle($vehicle);
        $OErt->setSimCard($simCard);
        $OErt->setGps($gps);

        return $OErt;
    }


    public function update(
        ErtId $id,
        ErtPeriod $period,
        ErtSutran $sutran,
        VehicleId $vehicleId,
        ErtIdType $idType,
        ErtIdGps $idGps,
        ErtIdSim $idSim
    ): ?Ert
    {
        $this->eloquentErtModel->findOrFail($id->value())->update([
            'period' => $period->value(),
            'sutran' => $sutran->value(),
            'id_vehicle' => $vehicleId->value(),
            'id_type' => $idType->value(),
            'id_gps' => $idGps->value(),
            'id_sim' => $idSim->value()
        ]);

        $ert = $this->eloquentErtModel->with(['idClient_pk','idVehicle_pk','idSimCard_pk','idGps_pk'])->findOrFail($id->value());

        $OErt = new Ert(
            new ErtId( $ert->id ),
            new ErtPeriod( $ert->period ),
            new ErtSutran( $ert->sutran ),
            new ErtIdClient( $ert->id_client ),
            new ErtIdVehicle( $ert->id_vehicle ),
            new ErtIdType( $ert->id_type ),
            new ErtIdGps( $ert->id_gps ),
            new ErtIdSim( $ert->id_sim )
        );

        $client = is_null($ert->idClient_pk) ? null : Client::createEntity($ert->idClient_pk);
        $vehicle = is_null($ert->idVehicle_pk) ? null : Vehicle::createEntity($ert->idVehicle_pk);
        $simCard = is_null($ert->idSimCard_pk) ? null : SimCard::createEntity($ert->idSimCard_pk);
        $gps = is_null($ert->idGps_pk) ? null : Gps::createEntity($ert->idGps_pk);

        $OErt->setClient($client);
        $OErt->setVehicle($vehicle);
        $OErt->setSimCard($simCard);
        $OErt->setGps($gps);

        return $OErt;
    }
    public function trash( ErtId $id ): void
    {
        $this->eloquentErtModel->findOrFail( $id->value() )->delete();
    }
    public function delete( ErtId $id ): void
    {
        $this->eloquentErtModel->withTrashed()->findOrFail( $id->value() )->forceDelete();
    }
    public function restore( ErtId $id ): void
    {
        $this->eloquentErtModel->withTrashed()->findOrFail( $id->value() )->restore();
    }

    public function collectionByClient(ClientId $idClient): array
    {
        $Erts = $this->eloquentErtModel->with(['idClient_pk','idVehicle_pk','idSimCard_pk','idGps_pk'])->where('id_client',$idClient->value())->get();

        $arrErts = array();

        foreach ( $Erts as $ert ){
            $OErt = new Ert(
                new ErtId( $ert->id ),
                new ErtPeriod( $ert->period ),
                new ErtSutran( $ert->sutran ),
                new ErtIdClient( $ert->id_client ),
                new ErtIdVehicle( $ert->id_vehicle ),
                new ErtIdType( $ert->id_type ),
                new ErtIdGps( $ert->id_gps ),
                new ErtIdSim( $ert->id_sim )
            );

            $client = is_null($ert->idClient_pk) ? null : Client::createEntity($ert->idClient_pk);
            $vehicle = is_null($ert->idVehicle_pk) ? null : Vehicle::createEntity($ert->idVehicle_pk);
            $simCard = is_null($ert->idSimCard_pk) ? null : SimCard::createEntity($ert->idSimCard_pk);
            $gps = is_null($ert->idGps_pk) ? null : Gps::createEntity($ert->idGps_pk);

            $OErt->setClient($client);
            $OErt->setVehicle($vehicle);
            $OErt->setSimCard($simCard);
            $OErt->setGps($gps);

            $arrErts[] = $OErt;
        }

        return $arrErts;
    }

    public function updateSutran( ErtId $id, ErtSutran $sutran ): void
    {
        $this->eloquentErtModel->findOrFail($id->value())->update([
            'sutran' => $sutran->value()
        ]);
    }

}
