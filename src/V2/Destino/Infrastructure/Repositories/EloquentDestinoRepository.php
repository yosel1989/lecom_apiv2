<?php

declare(strict_types=1);

namespace Src\V2\Destino\Infrastructure\Repositories;

use App\Models\V2\Destino as EloquentModelDestino;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Destino\Domain\Contracts\DestinoRepositoryContract;
use Src\V2\Destino\Domain\Destino;
use Src\V2\Destino\Domain\DestinoShort;

final class EloquentDestinoRepository implements DestinoRepositoryContract
{
    private EloquentModelDestino $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelDestino = new EloquentModelDestino;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelDestino->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Destino(
                new Id($model->id , false, 'El id de la destino no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la destino excede los 100 caracteres'),
                new NumericFloat($model->precioBase),
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

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelDestino->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new DestinoShort(
                new Id($model->id , false, 'El id del destino no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la destino excede los 100 caracteres'),
                new NumericFloat($model->precioBase),
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
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelDestino->create([
            'nombre' => $nombre->value(),
            'precioBase' => $precioBase->value(),
            'idCliente' => $idCliente->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioRegistro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelDestino->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'precioBase' => $precioBase->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idDestino,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelDestino->findOrFail($idDestino->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idDestino,
    ): Destino
    {
        $model = $this->eloquentModelDestino->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->findOrFail($idDestino->value());
        $OModel = new Destino(
            new Id($model->id , false, 'El id del destino no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del destino excede los 100 caracteres'),
            new NumericFloat($model->precioBase),
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

        return $OModel;
    }

}
