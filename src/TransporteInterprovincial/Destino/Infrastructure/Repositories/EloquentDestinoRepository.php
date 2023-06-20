<?php

declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Infrastructure\Repositories;

use App\Models\TransporteInterprovincial\Destino as EloquentModel;
use Src\Core\Domain\ValueObjects\Numeric;
use Src\Core\Domain\ValueObjects\Text;
use Src\TransporteInterprovincial\Destino\Domain\SmallDestino;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoIdBrand;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoIdFleet;
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
     * @var EloquentModel
     */
    private EloquentModel $eloquentModel;

    public function __construct()
    {
        $this->eloquentModel = new EloquentModel;
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



    public function create(
        Id $id,
        Text $nombre,
        Numeric $precioBase,
        Numeric $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModel->create([
            'id' => $id->value(),
            'nombre' => $nombre->value(),
            'precioBase' => $precioBase->value(),
            'idCliente' => $idCliente->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioRegistro' => $idUsuarioRegistro->value(),
        ]);
    }

    public function update(
        Id $id,
        Text $nombre,
        Numeric $precioBase,
        Numeric $idEstado,
        Id $idCliente,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModel->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'precioBase' => $precioBase->value(),
            'idCliente' => $idCliente->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioModifico->value(),
        ]);

    }

    public function find( Id $idDestino ): ?Destino
    {
        $Destino = $this->eloquentModel->findOrFail($idDestino->value());

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

    }

    public function collectionByClient(Id $idCliente): array;

    public function collectionActivedByClient(Id $idCliente): array;

}
