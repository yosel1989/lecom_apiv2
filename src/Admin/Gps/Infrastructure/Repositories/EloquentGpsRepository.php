<?php

declare(strict_types=1);

namespace Src\Admin\Gps\Infrastructure\Repositories;

use App\Models\Admin\Gps as EloquentGpsModel;
use Src\Admin\Client\Domain\Client;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Gps\Domain\Contracts\GpsRepositoryContract;
use Src\Admin\Gps\Domain\Gps;
use Src\Admin\Gps\Domain\ValueObjects\GpsId;
use Src\Admin\Gps\Domain\ValueObjects\GpsIdModel;
use Src\Admin\Gps\Domain\ValueObjects\GpsImei;
use Src\Admin\Gps\Domain\ValueObjects\GpsType;
use Src\Admin\GpsModel\Domain\GpsModel;

final class EloquentGpsRepository implements GpsRepositoryContract
{
    /**
     * @var EloquentGpsModel
     */
    private $EloquentGpsModel;

    public function __construct()
    {
        $this->EloquentGpsModel = new EloquentGpsModel;
    }

    public function find( GpsId $id ): ?Gps
    {
        $Gps = $this->EloquentGpsModel->findOrFail($id->value());
        // Return Domain Ticket model
        return new Gps(
            new GpsId( $Gps->id ),
            new GpsImei( $Gps->imei ),
            new GpsType( $Gps->type ),
            new ClientId( $Gps->id_client ),
            new GpsIdModel( $Gps->id_model )
        );

    }

    public function create( GpsId $id, GpsImei $imei,  GpsIdModel $idModel, GpsType $type, ClientId $clientId ): ?Gps
    {
        $this->EloquentGpsModel->create([
            'id'    => $id->value(),
            'imei'  => $imei->value(),
            'id_gps_model'  => $idModel->value(),
            'id_client'  => $clientId->value(),
            'type'  => $type->value()
        ]);

        $gps = $this->EloquentGpsModel->with(['idModel_pk','idClient_pk'])->findOrFail($id->value());

        $OGps = new Gps(
            new GpsId( $gps->id ),
            new GpsImei( $gps->imei ),
            new GpsType( $gps->type ),
            new ClientId( $gps->id_client ),
            new GpsIdModel( $gps->id_gps_model )
        );

        $gpsModel = is_null($gps->idModel_pk) ? null : GpsModel::createEntity($gps->idModel_pk);
        $client = is_null($gps->idClient_pk) ? null : Client::createEntity($gps->idClient_pk);

        $OGps->setGpsModel($gpsModel);
        $OGps->setClient($client);

        return $OGps;
    }

    public function update( GpsId $id, GpsImei $imei, GpsIdModel $idModel, GpsType $type ): ?Gps
    {
        $this->EloquentGpsModel->findOrFail($id->value())->update([
            'imei'  => $imei->value(),
            'id_gps_model'  => $idModel->value(),
            'type'  => $type->value()
        ]);

        $gps = $this->EloquentGpsModel->with(['idModel_pk','idClient_pk'])->findOrFail($id->value());

        $OGps = new Gps(
            new GpsId( $gps->id ),
            new GpsImei( $gps->imei ),
            new GpsType( $gps->type ),
            new ClientId( $gps->id_client ),
            new GpsIdModel( $gps->id_gps_model )
        );

        $gpsModel = is_null($gps->idModel_pk) ? null : GpsModel::createEntity($gps->idModel_pk);
        $client = is_null($gps->idClient_pk) ? null : Client::createEntity($gps->idClient_pk);

        $OGps->setGpsModel($gpsModel);
        $OGps->setClient($client);

        return $OGps;
    }

    public function trash( GpsId $id ): void
    {
        $this->EloquentGpsModel->findOrFail($id->value())->delete();
    }

    public function delete( GpsId $id ): void
    {
        $this->EloquentGpsModel->findOrFail($id->value())->forceDelete();
    }

    public function restore( GpsId $id ): void
    {
        $this->EloquentGpsModel->withTrashed()->findOrFail($id->value())->restore();
    }

    public function collection(): array
    {
        $Gpss = $this->EloquentGpsModel->with(['idModel_pk','idClient_pk'])->get();

        $arr = array();

        foreach ( $Gpss as $gps ){
            $OGps = new Gps(
                new GpsId( $gps->id ),
                new GpsImei( $gps->imei ),
                new GpsType( $gps->type ),
                new ClientId( $gps->id_client ),
                new GpsIdModel( $gps->id_gps_model )
            );

            $gpsModel = is_null($gps->idModel_pk) ? null : GpsModel::createEntity($gps->idModel_pk);
            $client = is_null($gps->idClient_pk) ? null : Client::createEntity($gps->idClient_pk);

            $OGps->setGpsModel($gpsModel);
            $OGps->setClient($client);

            $arr[] = $OGps;
        }

        return $arr;
    }

    public function collectionTrashed(): array
    {
        $Gpss = $this->EloquentGpsModel->onlyTrashed()->with(['idModel_pk','idClient_pk'])->get();

        $arr = array();

        foreach ( $Gpss as $gps ){
            $OGps = new Gps(
                new GpsId( $gps->id ),
                new GpsImei( $gps->imei ),
                new GpsType( $gps->type ),
                new ClientId( $gps->id_client ),
                new GpsIdModel( $gps->id_gps_model )
            );

            $gpsModel = is_null($gps->idModel_pk) ? null : GpsModel::createEntity($gps->idModel_pk);

            $OGps->setGpsModel($gpsModel);

            $arr[] = $OGps;
        }

        return $arr;
    }

    public function collectionByClient( ClientId $clientId ): array
    {
        $Gpss = $this->EloquentGpsModel->with(['idModel_pk','idClient_pk'])->where('id_client', $clientId->value() )->get();

        $arr = array();

        foreach ( $Gpss as $gps ){
            $OGps = new Gps(
                new GpsId( $gps->id ),
                new GpsImei( $gps->imei ),
                new GpsType( $gps->type ),
                new ClientId( $gps->id_client ),
                new GpsIdModel( $gps->id_gps_model )
            );

            $gpsModel = is_null($gps->idModel_pk) ? null : GpsModel::createEntity($gps->idModel_pk);
            $client = is_null($gps->idClient_pk) ? null : Client::createEntity($gps->idClient_pk);

            $OGps->setGpsModel($gpsModel);
            $OGps->setClient($client);

            $arr[] = $OGps;
        }

        return $arr;
    }

    public function collectionTrashedByClient( ClientId $clientId ): array
    {
        $Gpss = $this->EloquentGpsModel->onlyTrashed()->with(['idModel_pk','idClient_pk'])->get();

        $arr = array();

        foreach ( $Gpss as $gps ){
            $OGps = new Gps(
                new GpsId( $gps->id ),
                new GpsImei( $gps->imei ),
                new GpsType( $gps->type ),
                new ClientId( $gps->id_client ),
                new GpsIdModel( $gps->id_gps_model )
            );

            $gpsModel = is_null($gps->idModel_pk) ? null : GpsModel::createEntity($gps->idModel_pk);
            $client = is_null($gps->idClient_pk) ? null : Client::createEntity($gps->idClient_pk);

            $OGps->setGpsModel($gpsModel);
            $OGps->setClient($client);

            $arr[] = $OGps;
        }

        return $arr;
    }

}
