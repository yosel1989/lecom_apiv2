<?php

declare(strict_types=1);

namespace Src\Admin\Vehicle\Infrastructure\Repositories;

use App\Models\Administracion\Vehiculo as EloquentModelVehiculo;
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
use Src\Core\Domain\ValueObjects\Id;

final class EloquentVehicleRepository implements VehicleRepositoryContract
{
    /**
     * @var EloquentModelVehiculo
     */
    private $eloquentVehicleModel;

    public function __construct()
    {
        $this->EloquentModelVehiculo = new EloquentModelVehiculo;
    }

    public function create(
        Id $id,
        VehiclePlate $placa,
        VehicleUnit $unidad,
        Id $idCliente,
        Id $idCategoria,
        Id $idMarca,
        Id $idModelo,
        Id $idClase,
        Id $idFlota ): ?Vehicle
    {
        $nuevoVehiculo = $this->EloquentModelVehiculo->create([
            'id' => $id->value(),
            'placa' => $placa->value(),
            'unidad' => $unidad->value(),
            'idCliente' => $idCliente->value(),
            'idCategoria' => $idCategoria->value(),
            'idModelo' => $idModelo->value(),
            'idClase' => $idClase->value(),
            'idMarca' => $idMarca->value(),
            'idFlota' => $idFlota->value()
        ]);

        $vehicle = $this->EloquentModelVehiculo->with(['idBrand_pk','idFleet_pk','idModel_pk','idClass_pk'])->findOrFail($nuevoVehiculo->id);

        $OVehicle = new Vehicle(
            new VehicleId( $vehicle->id ),
            new VehiclePlate( $vehicle->placa ),
            new VehicleUnit( $vehicle->unidad ),
            new VehicleDeleted( $vehicle->idEliminado->value ),
            new VehicleIdClient( $vehicle->idCliente ),
            new VehicleIdCategory( $vehicle->idCategoria ),
            new VehicleIdModel( $vehicle->idModelo ),
            new VehicleIdClass( $vehicle->idClase ),
            new VehicleIdFleet( $vehicle->idFlota ),
            new VehicleIdBrand( $vehicle->idMarca )
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
        Id $id,
        VehiclePlate $placa,
        VehicleUnit $unidad,
        Id $idCategoria,
        Id $idMarca,
        Id $idModelo,
        Id $idClase,
        Id $idFlota
    ): ?Vehicle
    {
        $this->EloquentModelVehiculo->findOrFail($id->value())->update([
            'placa' => $placa->value(),
            'unidad' => $unidad->value(),
            'idCategoria' => $idCategoria->value(),
            'idModelo' => $idModelo->value(),
            'idClase' => $idClase->value(),
            'idMarca' => $idMarca->value(),
            'idFlota' => $idFlota->value()
        ]);

        $vehicle = $this->EloquentModelVehiculo->with(['idBrand_pk','idFleet_pk','idModel_pk','idClass_pk'])->findOrFail($id->value());

        $OVehicle = new Vehicle(
            new VehicleId( $vehicle->id ),
            new VehiclePlate( $vehicle->placa ),
            new VehicleUnit( $vehicle->unidad ),
            new VehicleDeleted( $vehicle->idEliminado->value ),
            new VehicleIdClient( $vehicle->idCliente ),
            new VehicleIdCategory( $vehicle->idCategoria ),
            new VehicleIdModel( $vehicle->idModelo ),
            new VehicleIdClass( $vehicle->idClase ),
            new VehicleIdFleet( $vehicle->idFlota ),
            new VehicleIdBrand( $vehicle->idMarca )
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
        Id $idVehiculo
    ): ?Vehicle
    {
        $vehicle = $this->EloquentModelVehiculo->with(['idBrand_pk','idFleet_pk','idModel_pk','idClass_pk'])->findOrFail($idVehiculo->value());

        $OVehicle = new Vehicle(
            new VehicleId( $vehicle->id ),
            new VehiclePlate( $vehicle->placa ),
            new VehicleUnit( $vehicle->unidad ),
            new VehicleDeleted( $vehicle->idEliminado->value ),
            new VehicleIdClient( $vehicle->idCliente ),
            new VehicleIdCategory( $vehicle->idCategoria ),
            new VehicleIdModel( $vehicle->idModelo ),
            new VehicleIdClass( $vehicle->idClase ),
            new VehicleIdFleet( $vehicle->idFlota ),
            new VehicleIdBrand( $vehicle->idMarca )
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

    public function trash( Id $idVehiculo ): void
    {
        $this->EloquentModelVehiculo->findOrFail( $idVehiculo->value() )->delete();
    }
    public function delete( Id $idVehiculo ): void
    {
        $this->EloquentModelVehiculo->withTrashed()->findOrFail( $idVehiculo->value() )->forceDelete();
    }
    public function restore( Id $idVehiculo ): void
    {
        $this->EloquentModelVehiculo->withTrashed()->findOrFail( $idVehiculo->value() )->restore();
    }

    public function collectionByClient(Id $idCliente): array
    {
        $vehicles = $this->EloquentModelVehiculo->with(['idBrand_pk','idFleet_pk','idModel_pk','idClass_pk'])->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $vehicles as $vehicle ){
            $OVehicle = new Vehicle(
                new VehicleId( $vehicle->id ),
                new VehiclePlate( $vehicle->placa ),
                new VehicleUnit( $vehicle->unidad ),
                new VehicleDeleted( $vehicle->idEliminado->value ),
                new VehicleIdClient( $vehicle->idCliente ),
                new VehicleIdCategory( $vehicle->idCategoria ),
                new VehicleIdModel( $vehicle->idModelo ),
                new VehicleIdClass( $vehicle->idClase ),
                new VehicleIdFleet( $vehicle->idFlota ),
                new VehicleIdBrand( $vehicle->idMarca )
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

    public function collectionActivedByClient(Id $idCliente): array
    {
        $vehicles = $this->EloquentModelVehiculo->where('idCliente',$idCliente->value())->where('idEstado',1)->get();

        $arrVehicles = array();

        foreach ( $vehicles as $vehicle ){
            $OVehicle = new SmallVehicle(
                new VehicleId( $vehicle->id ),
                new VehiclePlate( $vehicle->placa ),
                new VehicleUnit( $vehicle->unidad )
            );
            $arrVehicles[] = $OVehicle;
        }

        return $arrVehicles;
    }

}
