<?php

declare(strict_types=1);

namespace Src\V2\Pos\Infrastructure\Repositories;

use App\Models\V2\Pos as EloquentModelPos;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Pos\Domain\Contracts\PosRepositoryContract;
use Src\V2\Pos\Domain\Pos;
use Src\V2\Pos\Domain\PosShort;

final class EloquentPosRepository implements PosRepositoryContract
{
    private EloquentModelPos $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelPos = new EloquentModelPos;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelPos->with('sede:id,nombre', 'usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Pos(
                new Id($model->id , false, 'El id de la pos no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la pos excede los 100 caracteres'),
                new Text($model->imei, false, 25, 'El imei excede los 25 caracteres'),
                new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->idSede, false, 'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setSede(new Text(!is_null($model->sede) ? $model->sede->nombre : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelPos->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new PosShort(
                new Id($model->id , false, 'El id del pos no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la pos excede los 100 caracteres'),
                new Text($model->imei, false, 25, 'El imei excede los 25 caracteres'),
                new Id($model->idSede , false, 'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $nombre,
        Text $imei,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelPos->create([
            'nombre' => $nombre->value(),
            'imei' => $imei->value(),
            'idCliente' => $idCliente->value(),
            'idSede' => $idSede->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioRegistro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        Text $imei,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelPos->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'imei' => $imei->value(),
            'idSede' => $idSede->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idPos,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelPos->findOrFail($idPos->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idPos,
    ): Pos
    {
        $model = $this->eloquentModelPos->with('sede:id,nombre', 'usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->findOrFail($idPos->value());
        $OModel = new Pos(
            new Id($model->id , false, 'El id del pos no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del pos excede los 100 caracteres'),
            new Text($model->imei, false, 25, 'El imei excede los 25 caracteres'),
            new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->idSede, false, 'El id de la sede no tiene el formato correcto'),
            new NumericInteger($model->idEstado->value),
            new NumericInteger($model->idEliminado->value),
            new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setSede(new Text(!is_null($model->sede) ? $model->sede->nombre : null, true, -1));


        return $OModel;
    }

}
