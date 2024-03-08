<?php

declare(strict_types=1);

namespace Src\V2\Caja\Infrastructure\Repositories;

use App\Models\V2\Caja as EloquentModelCaja;
use App\Models\V2\CajaDiario;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\Caja\Domain\CajaSede;
use Src\V2\Caja\Domain\Contracts\CajaRepositoryContract;
use Src\V2\Caja\Domain\Caja;
use Src\V2\Caja\Domain\CajaShort;

final class EloquentCajaRepository implements CajaRepositoryContract
{
    private EloquentModelCaja $eloquentModelCaja;

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
            ->where('id_cliente',$idCliente->value())
            ->orderBy('f_registro','desc')
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Caja(
                new Id($model->id , false, 'El id de la caja no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la caja excede los 100 caracteres'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede, true, 'El id de la sede no tiene el formato correcto'),
                new Id($model->id_pos, true, 'El id del pos no tiene el formato correcto'),
                new ValueBoolean($model->bl_punto_venta),
                new ValueBoolean($model->bl_despacho),
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


            $aperturado = CajaDiario::where('id_caja',$model->id)->orderBy('f_apertura', 'desc')->limit(1);
            if($aperturado->count() === 0){
                $OModel->setAperturado(new ValueBoolean(false));
            }else{
                if(is_null($aperturado->first()->f_cierre)){
                    $OModel->setAperturado(new ValueBoolean(true));
                    $OModel->setIdCajaDiario(new Id($aperturado->first()->id, true, 'El id del historial de la caja no tiene el formato correcto'));
                }else{
                    $OModel->setAperturado(new ValueBoolean(false));
                }
            }


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

            $aperturado = CajaDiario::where('id_caja',$model->id)->orderBy('f_apertura', 'desc')->limit(1);
            if($aperturado->count() === 0){
                $OModel->setAperturado(new ValueBoolean(false));
            }else{
                if(is_null($aperturado->first()->f_cierre)){
                    $OModel->setAperturado(new ValueBoolean(true));
                    $OModel->setIdCajaDiario(new Id($aperturado->first()->id, true, 'El id del historial de la caja no tiene el formato correcto'));
                }else{
                    $OModel->setAperturado(new ValueBoolean(false));
                }
            }

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

    public function listBySedeDespacho(Id $idCliente, Id $idSede): array
    {
        $models = $this->eloquentModelCaja
            ->select(
                'id',
                'nombre',
                'id_cliente',
                'id_sede',
                'id_estado'
            )
            ->where('id_cliente',$idCliente->value())
            ->where('id_sede',$idSede->value())
            ->where('bl_despacho', true)
            ->where('id_estado', 1)
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new CajaSede(
                new Id($model->id , false, 'El id del caja no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la caja excede los 100 caracteres'),
                new Id($model->id_cliente , true, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_sede , true, 'El id de la sede no tiene el formato correcto'),
            );

            $arrVehicles[] = $OModel;


            $cajadiario = CajaDiario::with('estado:id,nombre')->where('id_caja',$model->id)->orderBy('f_apertura', 'desc')->limit(1);
            if($cajadiario->count() === 0){
                $OModel->setAperturado(new ValueBoolean(false));
                $OModel->setIdEstado(new NumericInteger(2));
                $OModel->setEstado(new Text('Cerrado', false, -1, ''));
                $OModel->setFechaApertura(new DateTimeFormat(null, true));
                $OModel->setIdCajaDiario(new Id(null, true, ''));
            }else{
                if(is_null($cajadiario->first()->f_cierre)){
                    $OModel->setAperturado(new ValueBoolean(true));
                    $OModel->setIdCajaDiario(new Id($cajadiario->first()->id, true, 'El id del historial de la caja no tiene el formato correcto'));
                    $OModel->setIdEstado(new NumericInteger($cajadiario->first()->estado->id));
                    $OModel->setEstado(new Text($cajadiario->first()->estado->nombre, false, -1, ''));
                    $OModel->setFechaApertura(new DateTimeFormat($cajadiario->first()->f_apertura, false));
                }else{
                    $OModel->setAperturado(new ValueBoolean(false));
                    $OModel->setIdEstado(new NumericInteger(2));
                    $OModel->setEstado(new Text('Cerrado', false, -1, ''));
                    $OModel->setFechaApertura(new DateTimeFormat(null, true));
                    $OModel->setIdCajaDiario(new Id(null, true, ''));
                }
            }
        }


        return $arrVehicles;
    }

    public function create(
        Text $nombre,
        Id $idCliente,
        Id $idSede,
        Id $idPos,
        ValueBoolean $blPuntoVenta,
        ValueBoolean $blDespacho,
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
            'bl_punto_venta' => $blPuntoVenta->value(),
            'bl_despacho' => $blDespacho->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_registro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        Id $idSede,
        Id $idPos,
        ValueBoolean $blPuntoVenta,
        ValueBoolean $blDespacho,
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
            'bl_punto_venta' => $blPuntoVenta->value(),
            'bl_despacho' => $blDespacho->value(),
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
            new ValueBoolean($model->bl_punto_venta),
            new ValueBoolean($model->bl_despacho),
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



        $aperturado = CajaDiario::where('id_caja',$model->id)->orderBy('f_apertura', 'desc')->limit(1);
        if($aperturado->count() === 0){
            $OModel->setAperturado(new ValueBoolean(false));
            $OModel->setIdCajaDiario(new Id(null,true, ''));
        }else{
            if(is_null($aperturado->first()->f_cierre)){
                $OModel->setAperturado(new ValueBoolean(true));
                $OModel->setIdCajaDiario(new Id($aperturado->first()->id, true, 'El id del historial de la caja no tiene el formato correcto'));
            }else{
                $OModel->setAperturado(new ValueBoolean(false));
                $OModel->setIdCajaDiario(new Id(null,true, ''));
            }
        }


        return $OModel;
    }



    public function findToDespacho(
        Id $idCaja,
        Id $idCajaDiario
    ): CajaSede
    {
        $model = $this->eloquentModelCaja
            ->select(
                'id',
                'nombre',
                'id_cliente',
                'id_sede',
                'id_estado'
            )
            ->where('bl_despacho', true)
            ->where('id_estado', 1)
            ->findOrFail($idCaja->value());

        $OModel = new CajaSede(
            new Id($model->id , false, 'El id del caja no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre de la caja excede los 100 caracteres'),
            new Id($model->id_cliente , true, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_sede , true, 'El id de la sede no tiene el formato correcto'),
        );


        $cajadiario = CajaDiario::with('estado:id,nombre')->where('id_caja', $idCaja->value())->findOrFail($idCajaDiario->value());
        $OModel->setAperturado(new ValueBoolean(true));
        $OModel->setIdCajaDiario(new Id($cajadiario->id, true, 'El id del historial de la caja no tiene el formato correcto'));
        $OModel->setIdEstado(new NumericInteger($cajadiario->estado->id));
        $OModel->setEstado(new Text($cajadiario->estado->nombre, false, -1, ''));
        $OModel->setFechaApertura(new DateTimeFormat($cajadiario->f_apertura, false));


        return $OModel;
    }

}
