<?php

declare(strict_types=1);

namespace Src\Admin\Vehicle\Infrastructure\Repositories;

use App\Models\General\Vehicle as EloquentVehicleModel;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Vehicle\Domain\SmallVehicle;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdBrand;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdFleet;
use Src\Admin\VehicleBrand\Domain\VehicleBrand;
use Src\Admin\VehicleClass\Domain\VehicleClass;
use Src\Admin\VehicleFleet\Domain\VehicleFleet;
use Src\Admin\VehicleModel\Domain\VehicleModel;
use Src\Admin\Vehicle\Domain\Contracts\VehicleRepositoryContract;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleDeleted;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleId;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdCategory;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdClass;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdClient;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleIdModel;
use Src\Admin\Vehicle\Domain\ValueObjects\VehiclePlate;
use Src\Admin\Vehicle\Domain\ValueObjects\VehicleUnit;
use Src\Admin\Vehicle\Domain\Vehicle;

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

    public function create(
        VehicleId $id,
        VehiclePlate $plate,
        VehicleUnit $unit,
        ClientId $idClient,
        VehicleIdCategory $idCategory,
        VehicleIdBrand $idBrand,
        VehicleIdModel $idModel,
        VehicleIdClass $idClass,
        VehicleIdFleet $idFleet ): ?Vehicle
    {
        $this->eloquentVehicleModel->create([
            'id' => $id->value(),
            'plate' => $plate->value(),
            'unit' => $unit->value(),
            'deleted' => 0,
            'id_client' => $idClient->value(),
            'id_category' => $idCategory->value(),
            'id_model' => $idModel->value(),
            'id_class' => $idClass->value(),
            'id_brand' => $idBrand->value(),
            'id_fleet' => $idFleet->value()
        ]);

        $vehicle = $this->eloquentVehicleModel->with(['idBrand_pk','idFleet_pk','idModel_pk','idClass_pk'])->findOrFail($id->value());

        $OVehicle = new Vehicle(
            new VehicleId( $vehicle->id ),
            new VehiclePlate( $vehicle->plate ),
            new VehicleUnit( $vehicle->unit ),
            new VehicleDeleted( $vehicle->deleted ),
            new VehicleIdClient( $vehicle->id_client ),
            new VehicleIdCategory( $vehicle->id_category ),
            new VehicleIdModel( $vehicle->id_model ),
            new VehicleIdClass( $vehicle->id_class ),
            new VehicleIdFleet( $vehicle->id_fleet ),
            new VehicleIdBrand( $vehicle->id_brand )
        );
        $brand = is_null($vehicle->idBrand_pk) ? null : VehicleBrand::createEntity($vehicle->idBrand_pk);
        $model = is_null($vehicle->idModel_pk) ? null : VehicleModel::createEntity($vehicle->idModel_pk);
        $class = is_null($vehicle->idClass_pk) ? null : VehicleClass::createEntity($vehicle->idClass_pk);
        $fleet = is_null($vehicle->idFleet_pk) ? null : VehicleFleet::createEntity($vehicle->idFleet_pk);

        $OVehicle->setBrand($brand);
        $OVehicle->setModel($model);
        $OVehicle->setClass($class);
        $OVehicle->setFleet($fleet);

        return $OVehicle;
    }


    public function update(
        VehicleId $id,
        VehiclePlate $plate,
        VehicleUnit $unit,
        VehicleIdCategory $idCategory,
        VehicleIdBrand $idBrand,
        VehicleIdModel $idModel,
        VehicleIdClass $idClass,
        VehicleIdFleet $idFleet
    ): ?Vehicle
    {
        $this->eloquentVehicleModel->findOrFail($id->value())->update([
            'plate' => $plate->value(),
            'unit' => $unit->value(),
            'id_category' => $idCategory->value(),
            'id_model' => $idModel->value(),
            'id_class' => $idClass->value(),
            'id_brand' => $idBrand->value(),
            'id_fleet' => $idFleet->value()
        ]);

        $vehicle = $this->eloquentVehicleModel->with(['idBrand_pk','idFleet_pk','idModel_pk','idClass_pk'])->findOrFail($id->value());

        $OVehicle = new Vehicle(
            new VehicleId( $vehicle->id ),
            new VehiclePlate( $vehicle->plate ),
            new VehicleUnit( $vehicle->unit ),
            new VehicleDeleted( $vehicle->deleted ),
            new VehicleIdClient( $vehicle->id_client ),
            new VehicleIdCategory( $vehicle->id_category ),
            new VehicleIdModel( $vehicle->id_model ),
            new VehicleIdClass( $vehicle->id_class ),
            new VehicleIdFleet( $vehicle->id_fleet ),
            new VehicleIdBrand( $vehicle->id_brand )
        );
        $brand = is_null($vehicle->idBrand_pk) ? null : VehicleBrand::createEntity($vehicle->idBrand_pk);
        $model = is_null($vehicle->idModel_pk) ? null : VehicleModel::createEntity($vehicle->idModel_pk);
        $class = is_null($vehicle->idClass_pk) ? null : VehicleClass::createEntity($vehicle->idClass_pk);
        $fleet = is_null($vehicle->idFleet_pk) ? null : VehicleFleet::createEntity($vehicle->idFleet_pk);

        $OVehicle->setBrand($brand);
        $OVehicle->setModel($model);
        $OVehicle->setClass($class);
        $OVehicle->setFleet($fleet);

        return $OVehicle;
    }

    public function find(
        VehicleId $id
    ): ?Vehicle
    {
        $vehicle = $this->eloquentVehicleModel->with(['idBrand_pk','idFleet_pk','idModel_pk','idClass_pk'])->findOrFail($id->value());

        $OVehicle = new Vehicle(
            new VehicleId( $vehicle->id ),
            new VehiclePlate( $vehicle->plate ),
            new VehicleUnit( $vehicle->unit ),
            new VehicleDeleted( $vehicle->deleted ),
            new VehicleIdClient( $vehicle->id_client ),
            new VehicleIdCategory( $vehicle->id_category ),
            new VehicleIdModel( $vehicle->id_model ),
            new VehicleIdClass( $vehicle->id_class ),
            new VehicleIdFleet( $vehicle->id_fleet ),
            new VehicleIdBrand( $vehicle->id_brand )
        );
        $brand = is_null($vehicle->idBrand_pk) ? null : VehicleBrand::createEntity($vehicle->idBrand_pk);
        $model = is_null($vehicle->idModel_pk) ? null : VehicleModel::createEntity($vehicle->idModel_pk);
        $class = is_null($vehicle->idClass_pk) ? null : VehicleClass::createEntity($vehicle->idClass_pk);
        $fleet = is_null($vehicle->idFleet_pk) ? null : VehicleFleet::createEntity($vehicle->idFleet_pk);

        $OVehicle->setBrand($brand);
        $OVehicle->setModel($model);
        $OVehicle->setClass($class);
        $OVehicle->setFleet($fleet);

        return $OVehicle;
    }

    public function trash( VehicleId $id ): void
    {
        $this->eloquentVehicleModel->findOrFail( $id->value() )->delete();
    }
    public function delete( VehicleId $id ): void
    {
        $this->eloquentVehicleModel->withTrashed()->findOrFail( $id->value() )->forceDelete();
    }
    public function restore( VehicleId $id ): void
    {
        $this->eloquentVehicleModel->withTrashed()->findOrFail( $id->value() )->restore();
    }

    public function collectionByClient(ClientId $idClient): array
    {
        $vehicles = $this->eloquentVehicleModel->with(['idBrand_pk','idFleet_pk','idModel_pk','idClass_pk'])->where('id_client',$idClient->value())->get();

        $arrVehicles = array();

        foreach ( $vehicles as $vehicle ){
            $OVehicle = new Vehicle(
                new VehicleId( $vehicle->id ),
                new VehiclePlate( $vehicle->plate ),
                new VehicleUnit( $vehicle->unit ),
                new VehicleDeleted( $vehicle->deleted ),
                new VehicleIdClient( $vehicle->id_client ),
                new VehicleIdCategory( $vehicle->id_category ),
                new VehicleIdModel( $vehicle->id_model ),
                new VehicleIdClass( $vehicle->id_class ),
                new VehicleIdFleet( $vehicle->id_fleet ),
                new VehicleIdBrand( $vehicle->id_brand )
            );
            $brand = is_null($vehicle->idBrand_pk) ? null : VehicleBrand::createEntity($vehicle->idBrand_pk);
            $model = is_null($vehicle->idModel_pk) ? null : VehicleModel::createEntity($vehicle->idModel_pk);
            $class = is_null($vehicle->idClass_pk) ? null : VehicleClass::createEntity($vehicle->idClass_pk);
            $fleet = is_null($vehicle->idFleet_pk) ? null : VehicleFleet::createEntity($vehicle->idFleet_pk);

            $OVehicle->setBrand($brand);
            $OVehicle->setModel($model);
            $OVehicle->setClass($class);
            $OVehicle->setFleet($fleet);
            $arrVehicles[] = $OVehicle;
        }

        return $arrVehicles;
    }

    public function collectionActivedByClient(ClientId $idClient): array
    {
        $vehicles = $this->eloquentVehicleModel->where('id_client',$idClient->value())->where('id_status',1)->get();

        $arrVehicles = array();

        foreach ( $vehicles as $vehicle ){
            $OVehicle = new SmallVehicle(
                new VehicleId( $vehicle->id ),
                new VehiclePlate( $vehicle->plate ),
                new VehicleUnit( $vehicle->unit )
            );
            $arrVehicles[] = $OVehicle;
        }

        return $arrVehicles;
    }

}
