<?php

declare(strict_types=1);

namespace Src\Admin\VehicleBrand\Infrastructure\Repositories;

use App\Models\General\VehicleBrand as EloquentVehicleBrandModel;
use Src\Admin\VehicleBrand\Domain\Contracts\VehicleBrandRepositoryContract;
use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandDeleted;
use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandId;
use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandName;
use Src\Admin\VehicleBrand\Domain\VehicleBrand;

final class EloquentVehicleBrandRepository implements VehicleBrandRepositoryContract
{
    /**
     * @var EloquentVehicleBrandModel
     */
    private $EloquentVehicleBrandModel;

    public function __construct()
    {
        $this->EloquentVehicleBrandModel = new EloquentVehicleBrandModel;
    }

    public function find(VehicleBrandId $id): ?VehicleBrand
    {
        $brand = $this->EloquentVehicleBrandModel->findOrFail($id->value());
        // Return Domain Ticket model
        return new VehicleBrand(
            new VehicleBrandId( $brand->id ),
            new VehicleBrandName( $brand->name ),
            new VehicleBrandDeleted( $brand->deleted )
        );

    }

    public function create( VehicleBrandId $id, VehicleBrandName $name ): ?VehicleBrand
    {
        $VehicleBrand = $this->EloquentVehicleBrandModel->create([
            'id'    => $id->value(),
            'name'  => $name->value()
        ]);

        return new VehicleBrand(
            new VehicleBrandId( $VehicleBrand->id ),
            new VehicleBrandName( $VehicleBrand->name ),
            new VehicleBrandDeleted(0)
        );
    }

    public function update( VehicleBrandId $id, VehicleBrandName $name ): ?VehicleBrand
    {
        $VehicleBrand = tap( $this->EloquentVehicleBrandModel->findOrFail($id->value()) )->update([
            'name'  => $name->value()
        ]);

        return new VehicleBrand(
            new VehicleBrandId( $VehicleBrand->id ),
            new VehicleBrandName( $VehicleBrand->name ),
            new VehicleBrandDeleted(0)
        );
    }

    public function trash( VehicleBrandId $id ): void
    {
        $this->EloquentVehicleBrandModel->findOrFail($id->value())->delete();
    }

    public function delete( VehicleBrandId $id ): void
    {
        $this->EloquentVehicleBrandModel->findOrFail($id->value())->forceDelete();
    }

    public function restore( VehicleBrandId $id ): void
    {
        $this->EloquentVehicleBrandModel->withTrashed()->findOrFail($id->value())->restore();
    }

    public function collection(): array
    {
        $brands = $this->EloquentVehicleBrandModel->all();

        $arrBrands = array();

        foreach ( $brands as $brand ){
            $arrBrands[] = new VehicleBrand(
                new VehicleBrandId( $brand->id ),
                new VehicleBrandName( $brand->name ),
                new VehicleBrandDeleted( $brand->deleted )
            );
        }

        return $arrBrands;
    }

    public function collectionTrashed(): array
    {
        $brands = $this->EloquentVehicleBrandModel->onlyTrashed()->get();

        $arrBrands = array();

        foreach ( $brands as $brand ){
            $arrBrands[] = new VehicleBrand(
                new VehicleBrandId( $brand->id ),
                new VehicleBrandName( $brand->name ),
                new VehicleBrandDeleted( $brand->deleted )
            );
        }

        return $arrBrands;
    }

}
