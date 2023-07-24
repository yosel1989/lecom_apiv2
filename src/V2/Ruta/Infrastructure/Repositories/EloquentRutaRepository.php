<?php

declare(strict_types=1);

namespace Src\V2\Ruta\Infrastructure\Repositories;

use App\Models\V2\Ruta as EloquentModelRuta;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Ruta\Domain\Contracts\RutaRepositoryContract;
use Src\V2\Ruta\Domain\Ruta;
use Src\V2\Ruta\Domain\RutaShort;

final class EloquentRutaRepository implements RutaRepositoryContract
{
    private EloquentModelRuta $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelRuta = new EloquentModelRuta;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelRuta->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'tipo:id,nombre')->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Ruta(
                new Id($model->id , false, 'El id de la Ruta no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la Ruta excede los 100 caracteres'),
                new NumericInteger($model->idTipo->value),
                new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setTipo(new Text(!is_null($model->tipo) ? $model->tipo->nombre : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelRuta->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new RutaShort(
                new Id($model->id , false, 'El id del Ruta no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la Ruta excede los 100 caracteres'),
                new NumericInteger($model->idTipo->value),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $nombre,
        NumericInteger $idTipo,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelRuta->create([
           'nombre' => $nombre->value(),
           'idTipo' => $idTipo->value(),
           'idCliente' => $idCliente->value(),
           'idEstado' => $idEstado->value(),
           'idUsuarioRegistro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        NumericInteger $idTipo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelRuta->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'idTipo' => $idTipo->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idRuta,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelRuta->findOrFail($idRuta->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idRuta,
    ): Ruta
    {
        $model = $this->eloquentModelRuta->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'tipo:id,nombre')->findOrFail($idRuta->value());
        $OModel = new Ruta(
            new Id($model->id , false, 'El id del Ruta no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del Ruta excede los 100 caracteres'),
            new NumericInteger($model->idTipo->value),
            new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
            new NumericInteger($model->idEstado->value),
            new NumericInteger($model->idEliminado->value),
            new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setTipo(new Text(!is_null($model->tipo) ? $model->tipo->nombre : null, true, -1));


        return $OModel;
    }

}
