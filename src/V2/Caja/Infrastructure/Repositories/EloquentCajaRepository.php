<?php

declare(strict_types=1);

namespace Src\V2\Caja\Infrastructure\Repositories;

use App\Models\V2\Caja as EloquentModelCaja;
use Illuminate\Support\Facades\DB;
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
        $models = $this->eloquentModelCaja->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'sede:id,nombre' ,
            'pos:id,nombre')
            ->where('id_cliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Caja(
                new Id($model->id , false, 'El id de la caja no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la caja excede los 100 caracteres'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede, true, 'El id de la sede no tiene el formato correcto'),
                new Id($model->id_pos, true, 'El id del pos no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
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
            ->select(
                'id',
                'nombre',
                'id_cliente',
                'id_sede'
            )
            ->where('id_cliente',$idCliente->value())
            ->where('id_sede',$idSede->value())->get();

        $arr = array();

        foreach ( $models as $model ){

            $OModel = new CajaSede(
                new Id($model->id , false, 'El id de la caja no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la caja excede los 100 caracteres'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede, true, 'El id de la sede no tiene el formato correcto'),
            );


            $arr[] = $OModel;
        }

        return $arr;
    }

    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelCaja
            ->select(
                'id',
                'nombre',
                'id_sede',
                'id_pos',
                'id_estado',
                'id_eliminado'
            )->where('id_cliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new CajaShort(
                new Id($model->id , false, 'El id del caja no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la caja excede los 100 caracteres'),
                new Id($model->id_sede , true, 'El id de la sede no tiene el formato correcto'),
                new Id($model->id_pos , true, 'El id del pos no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
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
        $count = $this->eloquentModelCaja->select('id')
            ->where('id_cliente', $idCliente->value())
            ->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )
            ->count();
        if($count > 0){
            throw new \InvalidArgumentException('La caja ya se encuentra registrada');
        }

        $this->eloquentModelCaja->create([
            'nombre' => $nombre->value(),
            'id_cliente' => $idCliente->value(),
            'id_sede' => $idSede->value(),
            'id_pos' => $idPos->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_registro' => $idUsuarioRegistro->value()
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
        $model = $this->eloquentModelCaja->findOrFail($id->value());

        $count = $this->eloquentModelCaja->select('id')
            ->where('id', '<>', $id->value())
            ->where('id_cliente', $model->id_cliente)
            ->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )
            ->count();
        if($count > 0){
            throw new \InvalidArgumentException('La caja ya se encuentra registrada');
        }

        $model->update([
            'nombre' => $nombre->value(),
            'id_sede' => $idSede->value(),
            'id_pos' => $idPos->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idCaja,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelCaja->findOrFail($idCaja->value())->update([
           'id_estado' => $idEstado->value(),
           'id_usu_modifico' => $idUsuarioModifico->value()
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
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_sede, true, 'El id de la sede no tiene el formato correcto'),
            new Id($model->id_pos, true, 'El id del pos no tiene el formato correcto'),
            new NumericInteger($model->id_estado->value),
            new NumericInteger($model->id_eliminado->value),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setSede(new Text(!is_null($model->sede) ? $model->sede->nombre : null, true, -1));
        $OModel->setPos(new Text(!is_null($model->pos) ? $model->pos->nombre : null, true, -1));


        return $OModel;
    }

}
