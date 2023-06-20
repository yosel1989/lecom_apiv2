<?php

declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Infrastructure\Repositories;

use App\Models\TransporteInterprovincialistracion\Vehiculo as EloquentModelVehiculo;
use Src\TransporteInterprovincial\Destino\Domain\SmallDestino;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoIdBrand;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoIdFleet;
use Src\TransporteInterprovincial\DestinoBrand\Domain\DestinoBrand;
use Src\TransporteInterprovincial\DestinoClass\Domain\DestinoClass;
use Src\TransporteInterprovincial\DestinoFleet\Domain\DestinoFleet;
use Src\TransporteInterprovincial\DestinoModel\Domain\DestinoModel;
use Src\TransporteInterprovincial\Destino\Domain\Contracts\DestinoRepositoryContract;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoDeleted;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoId;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoIdCategory;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoIdClass;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoIdClient;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoIdModel;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoPlate;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoUnit;
use Src\TransporteInterprovincial\Destino\Domain\Destino;
use Src\Core\Domain\ValueObjects\Id;

final class EloquentDestinoRepository implements DestinoRepositoryContract
{
    /**
     * @var EloquentModelVehiculo
     */
    private $eloquentDestinoModel;

    public function __construct()
    {
        $this->EloquentModelVehiculo = new EloquentModelVehiculo;
    }

    public function create(
        Id $id,
        DestinoPlate $placa,
        DestinoUnit $unidad,
        Id $idCliente,
        Id $idCategoria,
        Id $idMarca,
        Id $idModelo,
        Id $idClase,
        Id $idFlota ): ?Destino
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

        $Destino = $this->EloquentModelVehiculo->with(['idBrand_pk','idFleet_pk','idModel_pk','idClass_pk'])->findOrFail($nuevoVehiculo->id);

        $ODestino = new Destino(
            new DestinoId( $Destino->id ),
            new DestinoPlate( $Destino->placa ),
            new DestinoUnit( $Destino->unidad ),
            new DestinoDeleted( $Destino->idEliminado->value ),
            new DestinoIdClient( $Destino->idCliente ),
            new DestinoIdCategory( $Destino->idCategoria ),
            new DestinoIdModel( $Destino->idModelo ),
            new DestinoIdClass( $Destino->idClase ),
            new DestinoIdFleet( $Destino->idFlota ),
            new DestinoIdBrand( $Destino->idMarca )
        );
        $brand = is_null($Destino->idBrand_pk) ? null : DestinoBrand::createEntity($Destino->idBrand_pk);
        $model = is_null($Destino->idModel_pk) ? null : DestinoModel::createEntity($Destino->idModel_pk);
        $class = is_null($Destino->idClass_pk) ? null : DestinoClass::createEntity($Destino->idClass_pk);
        $fleet = is_null($Destino->idFleet_pk) ? null : DestinoFleet::createEntity($Destino->idFleet_pk);

        $ODestino->setBrand($brand);
        $ODestino->setModel($model);
        $ODestino->setClass($class);
        $ODestino->setFleet($fleet);

        return $ODestino;
    }


    public function update(
        Id $id,
        DestinoPlate $placa,
        DestinoUnit $unidad,
        Id $idCategoria,
        Id $idMarca,
        Id $idModelo,
        Id $idClase,
        Id $idFlota
    ): ?Destino
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

        $Destino = $this->EloquentModelVehiculo->with(['idBrand_pk','idFleet_pk','idModel_pk','idClass_pk'])->findOrFail($id->value());

        $ODestino = new Destino(
            new DestinoId( $Destino->id ),
            new DestinoPlate( $Destino->placa ),
            new DestinoUnit( $Destino->unidad ),
            new DestinoDeleted( $Destino->idEliminado->value ),
            new DestinoIdClient( $Destino->idCliente ),
            new DestinoIdCategory( $Destino->idCategoria ),
            new DestinoIdModel( $Destino->idModelo ),
            new DestinoIdClass( $Destino->idClase ),
            new DestinoIdFleet( $Destino->idFlota ),
            new DestinoIdBrand( $Destino->idMarca )
        );
        $brand = is_null($Destino->idBrand_pk) ? null : DestinoBrand::createEntity($Destino->idBrand_pk);
        $model = is_null($Destino->idModel_pk) ? null : DestinoModel::createEntity($Destino->idModel_pk);
        $class = is_null($Destino->idClass_pk) ? null : DestinoClass::createEntity($Destino->idClass_pk);
        $fleet = is_null($Destino->idFleet_pk) ? null : DestinoFleet::createEntity($Destino->idFleet_pk);

        $ODestino->setBrand($brand);
        $ODestino->setModel($model);
        $ODestino->setClass($class);
        $ODestino->setFleet($fleet);

        return $ODestino;
    }

    public function find(
        Id $idVehiculo
    ): ?Destino
    {
        $Destino = $this->EloquentModelVehiculo->with(['idBrand_pk','idFleet_pk','idModel_pk','idClass_pk'])->findOrFail($idVehiculo->value());

        $ODestino = new Destino(
            new DestinoId( $Destino->id ),
            new DestinoPlate( $Destino->placa ),
            new DestinoUnit( $Destino->unidad ),
            new DestinoDeleted( $Destino->idEliminado->value ),
            new DestinoIdClient( $Destino->idCliente ),
            new DestinoIdCategory( $Destino->idCategoria ),
            new DestinoIdModel( $Destino->idModelo ),
            new DestinoIdClass( $Destino->idClase ),
            new DestinoIdFleet( $Destino->idFlota ),
            new DestinoIdBrand( $Destino->idMarca )
        );
        $brand = is_null($Destino->idBrand_pk) ? null : DestinoBrand::createEntity($Destino->idBrand_pk);
        $model = is_null($Destino->idModel_pk) ? null : DestinoModel::createEntity($Destino->idModel_pk);
        $class = is_null($Destino->idClass_pk) ? null : DestinoClass::createEntity($Destino->idClass_pk);
        $fleet = is_null($Destino->idFleet_pk) ? null : DestinoFleet::createEntity($Destino->idFleet_pk);

        $ODestino->setBrand($brand);
        $ODestino->setModel($model);
        $ODestino->setClass($class);
        $ODestino->setFleet($fleet);

        return $ODestino;
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
        $Destinos = $this->EloquentModelVehiculo->with(['idBrand_pk','idFleet_pk','idModel_pk','idClass_pk'])->where('idCliente',$idCliente->value())->get();

        $arrDestinos = array();

        foreach ( $Destinos as $Destino ){
            $ODestino = new Destino(
                new DestinoId( $Destino->id ),
                new DestinoPlate( $Destino->placa ),
                new DestinoUnit( $Destino->unidad ),
                new DestinoDeleted( $Destino->idEliminado->value ),
                new DestinoIdClient( $Destino->idCliente ),
                new DestinoIdCategory( $Destino->idCategoria ),
                new DestinoIdModel( $Destino->idModelo ),
                new DestinoIdClass( $Destino->idClase ),
                new DestinoIdFleet( $Destino->idFlota ),
                new DestinoIdBrand( $Destino->idMarca )
            );
            $brand = is_null($Destino->idBrand_pk) ? null : DestinoBrand::createEntity($Destino->idBrand_pk);
            $model = is_null($Destino->idModel_pk) ? null : DestinoModel::createEntity($Destino->idModel_pk);
            $class = is_null($Destino->idClass_pk) ? null : DestinoClass::createEntity($Destino->idClass_pk);
            $fleet = is_null($Destino->idFleet_pk) ? null : DestinoFleet::createEntity($Destino->idFleet_pk);

            $ODestino->setBrand($brand);
            $ODestino->setModel($model);
            $ODestino->setClass($class);
            $ODestino->setFleet($fleet);
            $arrDestinos[] = $ODestino;
        }

        return $arrDestinos;
    }

    public function collectionActivedByClient(Id $idCliente): array
    {
        $Destinos = $this->EloquentModelVehiculo->where('idCliente',$idCliente->value())->where('idEstado',1)->get();

        $arrDestinos = array();

        foreach ( $Destinos as $Destino ){
            $ODestino = new SmallDestino(
                new DestinoId( $Destino->id ),
                new DestinoPlate( $Destino->placa ),
                new DestinoUnit( $Destino->unidad )
            );
            $arrDestinos[] = $ODestino;
        }

        return $arrDestinos;
    }

}
