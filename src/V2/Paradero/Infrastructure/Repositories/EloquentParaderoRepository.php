<?php

declare(strict_types=1);

namespace Src\V2\Paradero\Infrastructure\Repositories;

use App\Models\V2\Paradero as EloquentModelParadero;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Paradero\Domain\Contracts\ParaderoRepositoryContract;
use Src\V2\Paradero\Domain\Paradero;
use Src\V2\Paradero\Domain\ParaderoShort;

final class EloquentParaderoRepository implements ParaderoRepositoryContract
{
    private EloquentModelParadero $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelParadero = new EloquentModelParadero;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelParadero->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'ruta:id,nombre',
            'tipoRuta:id,nombre',
        )->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Paradero(
                new Id($model->id , false, 'El id de la destino no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la destino excede los 100 caracteres'),
                new NumericFloat($model->precioBase),
                new NumericFloat($model->latitud),
                new NumericFloat($model->longitud),
                new NumericInteger($model->idTipoRuta->value),
                new Id($model->idRuta, false, 'El id de la ruta no tiene el formato correcto'),
                new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setRuta(new Text(!is_null($model->ruta) ?  $model->ruta->nombre  : null, true, -1));
            $OModel->setTipoRuta(new Text(!is_null($model->tipoRuta) ?  $model->tipoRuta->nombre  : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelParadero->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new ParaderoShort(
                new Id($model->id , false, 'El id del destino no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la destino excede los 100 caracteres'),
                new NumericFloat($model->precioBase),
                new NumericInteger($model->idTipoRuta->value),
                new Id($model->idRuta , false, 'El id de la ruta no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $nombre,
        NumericFloat $precioBase,
        NumericFloat $latitud,
        NumericFloat $longitud,
        NumericInteger $idTipoRuta,
        Id $idRuta,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelParadero->create([
            'nombre' => $nombre->value(),
            'precioBase' => $precioBase->value(),
            'latitud' => $latitud->value(),
            'longitud' => $longitud->value(),
            'idTipoRuta' => $idTipoRuta->value(),
            'idRuta' => $idRuta->value(),
            'idCliente' => $idCliente->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioRegistro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        NumericFloat $precioBase,
        NumericFloat $latitud,
        NumericFloat $longitud,
        NumericInteger $idTipoRuta,
        Id $idRuta,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelParadero->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'precioBase' => $precioBase->value(),
            'latitud' => $latitud->value(),
            'longitud' => $longitud->value(),
            'idTipoRuta' => $idTipoRuta->value(),
            'idRuta' => $idRuta->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idParadero,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelParadero->findOrFail($idParadero->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idParadero,
    ): Paradero
    {
        $model = $this->eloquentModelParadero->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'ruta:id,nombre',
            'tipoRuta:id,nombre',
        )->findOrFail($idParadero->value());
        $OModel = new Paradero(
            new Id($model->id , false, 'El id de la destino no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre de la destino excede los 100 caracteres'),
            new NumericFloat($model->precioBase),
            new NumericFloat($model->latitud),
            new NumericFloat($model->longitud),
            new NumericInteger($model->idTipoRuta->value),
            new Id($model->idRuta, false, 'El id de la ruta no tiene el formato correcto'),
            new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
            new NumericInteger($model->idEstado->value),
            new NumericInteger($model->idEliminado->value),
            new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setRuta(new Text(!is_null($model->ruta) ?  $model->ruta->nombre  : null, true, -1));
        $OModel->setTipoRuta(new Text(!is_null($model->tipoRuta) ?  $model->tipoRuta->nombre  : null, true, -1));


        return $OModel;
    }

}
