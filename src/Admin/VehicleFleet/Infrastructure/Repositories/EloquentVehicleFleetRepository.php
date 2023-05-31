<?php

declare(strict_types=1);

namespace Src\Admin\VehicleFleet\Infrastructure\Repositories;

use App\Models\General\VehicleFleet as EloquentVehicleFleetModel;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\VehicleFleet\Domain\Contracts\VehicleFleetRepositoryContract;
use Src\Admin\VehicleFleet\Domain\ValueObjects\VehicleFleetDeleted;
use Src\Admin\VehicleFleet\Domain\ValueObjects\VehicleFleetId;
use Src\Admin\VehicleFleet\Domain\ValueObjects\VehicleFleetName;
use Src\Admin\VehicleFleet\Domain\VehicleFleet;

final class EloquentVehicleFleetRepository implements VehicleFleetRepositoryContract
{
    /**
     * @var EloquentVehicleFleetModel
     */
    private $EloquentVehicleFleetModel;

    public function __construct()
    {
        $this->EloquentVehicleFleetModel = new EloquentVehicleFleetModel;
    }

    public function find(VehicleFleetId $id): ?VehicleFleet
    {
        $brand = $this->EloquentVehicleFleetModel->findOrFail($id->value());
        // Return Domain Ticket model
        return new VehicleFleet(
            new VehicleFleetId( $brand->id ),
            new VehicleFleetName( $brand->name ),
            new VehicleFleetDeleted( $brand->deleted ),
            new ClientId( $brand->id_client )
        );

    }

    public function collectionByCLient( ClientId $clientId ): array
    {
        $brands = $this->EloquentVehicleFleetModel->where('id_client',$clientId->value())->get();

        $arrBrands = array();

        foreach ( $brands as $brand ){
            $arrBrands[] = new VehicleFleet(
                new VehicleFleetId( $brand->id ),
                new VehicleFleetName( $brand->name ),
                new VehicleFleetDeleted( $brand->deleted ),
                new ClientId( $brand->id_client )
            );
        }

        return $arrBrands;
    }

    public function collectionTrashedByClient( ClientId $clientId ): array
    {
        $brands = $this->EloquentVehicleFleetModel->onlyTrashed()->where('id_client',$clientId->value())->get();

        $arrBrands = array();

        foreach ( $brands as $brand ){
            $arrBrands[] = new VehicleFleet(
                new VehicleFleetId( $brand->id ),
                new VehicleFleetName( $brand->name ),
                new VehicleFleetDeleted( $brand->deleted ),
                new ClientId( $brand->id_client )
            );
        }

        return $arrBrands;
    }

}
