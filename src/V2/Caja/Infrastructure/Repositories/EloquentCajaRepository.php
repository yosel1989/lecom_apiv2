<?php

declare(strict_types=1);

namespace Src\V2\Caja\Infrastructure\Repositories;

use App\Models\V2\Caja as EloquentModelCaja;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Caja\Domain\CajaSede;
use Src\V2\Caja\Domain\Contracts\CajaRepositoryContract;
use Src\V2\Caja\Domain\Caja;
use Src\V2\Caja\Domain\CajaShort;

final class EloquentCajaRepository implements CajaRepositoryContract
{
    private EloquentModelCaja $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelCaja = new EloquentModelCaja;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelCaja->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'sede:id,nombre' , 'pos:id,nombre')->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Caja(
                new Id($model->id , false, 'El id de la caja no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la caja excede los 100 caracteres'),
                new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->idSede, true, 'El id de la sede no tiene el formato correcto'),
                new Id($model->idPos, true, 'El id del pos no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setSede(new Text(!is_null($model->sede) ? $model->sede->nombre : null, true, -1));
            $OModel->setPos(new Text(!is_null($model->pos) ? $model->pos->nombre : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function listBySede(Id $idCliente, Id $idSede): array
    {
        $models = $this->eloquentModelCaja
            ->where('idCliente',$idCliente->value())
            ->where('idSede',$idSede->value())->get();

        $arr = array();

        foreach ( $models as $model ){

            $OModel = new CajaSede(
                new Id($model->id , false, 'El id de la caja no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la caja excede los 100 caracteres'),
                new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->idSede, true, 'El id de la sede no tiene el formato correcto'),
            );


            $arr[] = $OModel;
        }

        return $arr;
    }

    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelCaja->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new CajaShort(
                new Id($model->id , false, 'El id del caja no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la caja excede los 100 caracteres'),
                new Id($model->idSede , true, 'El id de la sede no tiene el formato correcto'),
                new Id($model->idPos , true, 'El id del pos no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $nombre,
        Id $idCliente,
        Id $idSede,
        Id $idPos,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelCaja->create([
            'nombre' => $nombre->value(),
            'idCliente' => $idCliente->value(),
            'idSede' => $idSede->value(),
            'idPos' => $idPos->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioRegistro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        Id $idSede,
        Id $idPos,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $this->eloquentModelCaja->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'idSede' => $idSede->value(),
            'idPos' => $idPos->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idCaja,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelCaja->findOrFail($idCaja->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idCaja,
    ): Caja
    {
        $model = $this->eloquentModelCaja->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'sede:id,nombre')->findOrFail($idCaja->value());
        $OModel = new Caja(
            new Id($model->id , false, 'El id del caja no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del caja excede los 100 caracteres'),
            new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->idSede, true, 'El id de la sede no tiene el formato correcto'),
            new Id($model->idPos, true, 'El id del pos no tiene el formato correcto'),
            new NumericInteger($model->idEstado->value),
            new NumericInteger($model->idEliminado->value),
            new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setSede(new Text(!is_null($model->sede) ? $model->sede->nombre : null, true, -1));
        $OModel->setPos(new Text(!is_null($model->pos) ? $model->pos->nombre : null, true, -1));


        return $OModel;
    }

}
