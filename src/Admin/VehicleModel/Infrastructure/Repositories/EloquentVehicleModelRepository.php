<?php

declare(strict_types=1);

namespace Src\Admin\VehicleModel\Infrastructure\Repositories;

use App\Models\General\VehicleModel as EloquentVehicleModelModel;
use Src\Admin\VehicleBrand\Domain\ValueObjects\VehicleBrandId;
use Src\Admin\VehicleBrand\Domain\VehicleBrand;
use Src\Admin\VehicleModel\Domain\Contracts\VehicleModelRepositoryContract;
use Src\Admin\VehicleModel\Domain\ValueObjects\VehicleModelDeleted;
use Src\Admin\VehicleModel\Domain\ValueObjects\VehicleModelId;
use Src\Admin\VehicleModel\Domain\ValueObjects\VehicleModelName;
use Src\Admin\VehicleModel\Domain\VehicleModel;

final class EloquentVehicleModelRepository implements VehicleModelRepositoryContract
{
    /**
     * @var EloquentVehicleModelModel
     */
    private $EloquentVehicleModelModel;

    public function __construct()
    {
        $this->EloquentVehicleModelModel = new EloquentVehicleModelModel;
    }

    public function find(VehicleModelId $id): ?VehicleModel
    {
        $model = $this->EloquentVehicleModelModel->findOrFail($id->value());
        // Return Domain Ticket model
        return new VehicleModel(
            new VehicleModelId( $model->id ),
            new VehicleModelName( $model->name ),
            new VehicleModelDeleted( $model->deleted ),
            new VehicleBrandId( $model->id_vehicle_brand )
        );

    }

    public function create( VehicleModelId $id, VehicleModelName $name, VehicleBrandId $idBrand ): ?VehicleModel
    {
        $this->EloquentVehicleModelModel->create([
            'id'    => $id->value(),
            'name'  => $name->value(),
            'id_vehicle_brand' => $idBrand->value()
        ]);

        $VehicleModel = $this->EloquentVehicleModelModel->with('idBrand_pk')->findOrFail($id->value());

        $OVehicleModel = new VehicleModel(
            new VehicleModelId( $VehicleModel->id ),
            new VehicleModelName( $VehicleModel->name ),
            new VehicleModelDeleted(0),
            new VehicleBrandId( $VehicleModel->id_vehicle_brand )
        );
        $OVehicleModel->setBrand( $VehicleModel->idBrand_pk ? VehicleBrand::createEntity($VehicleModel->idBrand_pk) : null );

        return $OVehicleModel;
    }

    public function update( VehicleModelId $id, VehicleModelName $name, VehicleBrandId $idBrand ): ?VehicleModel
    {
        $this->EloquentVehicleModelModel->with('idBrand_pk')->findOrFail($id->value())->update([
            'name'  => $name->value(),
            'id_vehicle_brand' => $idBrand->value()
        ]);

        $VehicleModel = $this->EloquentVehicleModelModel->with('idBrand_pk')->findOrFail($id->value());

        $OVehicleModel = new VehicleModel(
            new VehicleModelId( $VehicleModel->id ),
            new VehicleModelName( $VehicleModel->name ),
            new VehicleModelDeleted(0),
            new VehicleBrandId( $VehicleModel->id_vehicle_brand )
        );
        $OVehicleModel->setBrand( $VehicleModel->idBrand_pk ? VehicleBrand::createEntity($VehicleModel->idBrand_pk) : null );

        return $OVehicleModel;
    }

    public function trash( VehicleModelId $id ): void
    {
        $this->EloquentVehicleModelModel->findOrFail($id->value())->delete();
    }

    public function delete( VehicleModelId $id ): void
    {
        $this->EloquentVehicleModelModel->findOrFail($id->value())->forceDelete();
    }

    public function restore( VehicleModelId $id ): void
    {
        $this->EloquentVehicleModelModel->withTrashed()->findOrFail($id->value())->restore();
    }

    public function collection(): array
    {
        $models = $this->EloquentVehicleModelModel->with('idBrand_pk')->get();

        $arrBrands = array();

        foreach ( $models as $model ){
            $OVehicleModel = new VehicleModel(
                new VehicleModelId( $model->id ),
                new VehicleModelName( $model->name ),
                new VehicleModelDeleted( $model->deleted ),
                new VehicleBrandId( $model->id_vehicle_brand )
            );
            $OVehicleModel->setBrand( !is_null($model->idBrand_pk) ? VehicleBrand::createEntity($model->idBrand_pk) : null );
            $arrBrands[] = $OVehicleModel;
        }

        return $arrBrands;
    }

    public function collectionTrashed(): array
    {
        $models = $this->EloquentVehicleModelModel->with('idBrand_pk')->onlyTrashed()->get();

        $arrBrands = array();

        foreach ( $models as $model ){
            $OVehicleModel = new VehicleModel(
                new VehicleModelId( $model->id ),
                new VehicleModelName( $model->name ),
                new VehicleModelDeleted( $model->deleted ),
                new VehicleBrandId( $model->id_vehicle_brand )
            );
            $OVehicleModel->setBrand( $model->idBrand_pk ? VehicleBrand::createEntity($model->idBrand_pk) : null );
            $arrBrands[] = $OVehicleModel;
        }

        return $arrBrands;
    }

    public function collectionByBrand( VehicleBrandId $idBrand ): array
    {
        $models = $this->EloquentVehicleModelModel->with('idBrand_pk')->where('id_vehicle_brand',$idBrand->value())->get();

        $arrBrands = array();

        foreach ( $models as $model ){
            $OVehicleModel = new VehicleModel(
                new VehicleModelId( $model->id ),
                new VehicleModelName( $model->name ),
                new VehicleModelDeleted( $model->deleted ),
                new VehicleBrandId( $model->id_vehicle_brand )
            );
            $OVehicleModel->setBrand( $model->idBrand_pk ? VehicleBrand::createEntity($model->idBrand_pk) : null );
            $arrBrands[] = $OVehicleModel;
        }

        return $arrBrands;
    }

}
