<?php

declare(strict_types=1);

namespace Src\V2\Vehiculo\Infrastructure\Repositories;

use App\Models\V2\Vehiculo as EloquentModelVehiculo;
use App\Models\V2\UsuarioVehiculo as EloquentModelUsuarioVehiculo;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Vehiculo\Domain\Contracts\VehiculoRepositoryContract;
use Src\V2\Vehiculo\Domain\UsuarioVehiculo;
use Src\V2\Vehiculo\Domain\Vehiculo;
use Src\V2\Vehiculo\Domain\VehiculoList;

final class EloquentVehiculoRepository implements VehiculoRepositoryContract
{
    private EloquentModelVehiculo $eloquentModelVehiculo;
    private EloquentModelUsuarioVehiculo $eloquentUserVehicleModel;

    public function __construct()
    {
        $this->eloquentModelVehiculo = new EloquentModelVehiculo;
        $this->eloquentUserVehicleModel = new EloquentModelUsuarioVehiculo;
    }



    public function collectionByCliente(Id $idCliente): array
    {
        $vehicles = $this->eloquentModelVehiculo->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->where('id_cliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $vehicles as $model ){

            $OModel = new Vehiculo(
                new Id($model->id , false, 'El id del vehiculo no tiene el formato correcto'),
                new Text($model->placa, false, 7, 'La placa excede los 7 caracteres'),
                new Text($model->unidad, false, 10, 'La unidad excede los 10 caracteres'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_marca, true, 'El id de la marca del vehiculo no tiene el formato correcto'),
                new Id($model->id_modelo, true, 'El id del modelo del vehiculo no tiene el formato correcto'),
                new Id($model->id_clase, true, 'El id de la clase del vehiculo no tiene el formato correcto'),
                new Id($model->id_flota, true, 'El id de la flota del vehiculo no tiene el formato correcto'),
                new Id($model->id_categoria, true, 'El id de la categoria del vehiculo no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function listByCliente(Id $idCliente): array
    {
        $vehicles = $this->eloquentModelVehiculo
            ->select(
                'id',
                'placa',
                'unidad'
            )
            ->where('id_cliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $vehicles as $model ){

            $OModel = new VehiculoList(
                new Id($model->id , false, 'El id del vehiculo no tiene el formato correcto'),
                new Text($model->placa, false, 7, 'La placa excede los 7 caracteres'),
                new Text($model->unidad, false, 10, 'La unidad excede los 10 caracteres'),
            );
            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByUsuario(Id $idUsuario): array
    {
        $relation = $this->eloquentUserVehicleModel->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->where('idUsuario',$idUsuario->value())->get();

        if($relation->isEmpty()){
            return [];
        }

        $relation = $relation->first();

        $rel = json_decode($relation->vehiculos);

        foreach ( $rel as $model ){

            if($model->id !== '0'){
                $vehicle = $this->eloquentModelVehiculo->findOrFail($rel->id);

                $OModel = new UsuarioVehiculo(
                    new Id($vehicle->id , false, 'El id del vehiculo no tiene el formato correcto'),
                    new Text($vehicle->placa, false, -1, ''),
                    new Text($vehicle->unidad, false, -1, ''),
                    new Id($relation->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                    new Id($relation->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                    new DateTimeFormat($relation->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                    new DateTimeFormat($relation->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
                );
            }else{
                $OModel = new UsuarioVehiculo(
                    new Text($model->id , false, -1),
                    new Text($model->placa, false, -1, ''),
                    new Text($model->unidad, false, -1, ''),
                    new Id($relation->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                    new Id($relation->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                    new DateTimeFormat($relation->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                    new DateTimeFormat($relation->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
                );
            }

            $OModel->setUsuarioRegistro(new Text(!is_null($relation->usuarioRegistro) ? ( $relation->usuarioRegistro->nombres . ' ' . $relation->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($relation->usuarioModifico) ? ( $relation->usuarioModifico->nombres . ' ' . $relation->usuarioModifico->apellidos ) : null, true, -1));


            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function asignarUsuario(Id $idUsuario, Text $vehiculos, Id $idUsuarioRegistro): void
    {
        $relacion = $this->eloquentUserVehicleModel->select('id')->where('id_usuario', $idUsuario->value())->get();
        if(!$relacion->isEmpty()){
            $this->eloquentUserVehicleModel->findOrFail($relacion->first()->id)->update([
                'vehiculos' => $vehiculos->value(),
                'id_usu_modifico' => $idUsuarioRegistro->value(),
            ]);
        }else{
            $this->eloquentUserVehicleModel->create([
                'id_usuario' => $idUsuario->value(),
                'vehiculos' => $vehiculos->value(),
                'id_usu_registro' => $idUsuarioRegistro->value(),
                'id_usu_modifico' => $idUsuarioRegistro->value(),
            ]);
        }
    }

    public function create(
        Text $placa,
        Text $unidad,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $count = $this->eloquentModelVehiculo->select('id')->where('id_cliente',$idCliente->value())->count();

        // Validar la unidad
        if($this->eloquentModelVehiculo->where('unidad',$unidad->value())->where('id_cliente',$idCliente->value())->count() > 0){
            throw new \InvalidArgumentException('La unidad ya se encuentra registrada');
        }

        // Validar la placa en otro cliente
        if($this->eloquentModelVehiculo->select('id')
                ->where('id_cliente', '<>', $idCliente->value())
                ->where(DB::raw("UPPER(placa)"), '=',  mb_strtoupper($placa->value(), 'UTF-8') )
                ->count() > 0){
            throw new \InvalidArgumentException('La placa ya se encuentra registrada en el sistema con otro cliente');
        }

        // validar placa
        if($this->eloquentModelVehiculo->select('id')
                ->where('id_cliente', $idCliente->value())
                ->where(DB::raw("UPPER(placa)"), '=',  mb_strtoupper($placa->value(), 'UTF-8') )
                ->count() > 0){
            throw new \InvalidArgumentException('La placa ya se encuentra registrada');
        }
//        $countPlaca = $this->eloquentModelVehiculo->select('id')->where(DB::raw("UPPER(placa)"), mb_strtoupper($placa->value(), 'UTF-8') )->count();
//        if($countPlaca > 0){
//            throw new \InvalidArgumentException('La placa ya se encuentra registrada en el sistema con otro cliente');
//        }

        if($this->eloquentModelVehiculo->select('id')->where('id_cliente', $idCliente->value())->where('codigo', ($count + 1) )->count() > 0){
            throw new \InvalidArgumentException('El código de vehiculo ya se encuentra registrado');
        }


        $this->eloquentModelVehiculo->create([
           'placa' => $placa->value(),
           'codigo' => ($count + 1) ,
           'unidad' => $unidad->value(),
           'id_cliente' => $idCliente->value(),
           'id_estado' => $idEstado->value(),
           'id_usu_registro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $placa,
        Text $unidad,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $vehiculo = $this->eloquentModelVehiculo->findOrFail($id->value());

        // Validar la unidad
        if($this->eloquentModelVehiculo->where('unidad',$unidad->value())->where('id_cliente',$vehiculo->id_cliente)->count() > 0){
            throw new \InvalidArgumentException('La unidad ya se encuentra registrada');
        }

        // Validar la placa en otro cliente
        if($this->eloquentModelVehiculo->select('id')
                ->where('id_cliente', '<>', $vehiculo->id_cliente)
                ->where(DB::raw("UPPER(placa)"), '=',  mb_strtoupper($placa->value(), 'UTF-8') )
                ->count() > 0){
            throw new \InvalidArgumentException('La placa ya se encuentra registrada en el sistema con otro cliente');
        }

        // validar placa
        if($this->eloquentModelVehiculo->select('id')
                ->where('id', '<>', $id->value())
                ->where('id_cliente', $vehiculo->id_cliente)
                ->where(DB::raw("UPPER(placa)"), mb_strtoupper($placa->value(), 'UTF-8') )
                ->count() > 0){
            throw new \InvalidArgumentException('La placa ya se encuentra registrada');
        }

        $vehiculo->update([
            'placa' => $placa->value(),
            'unidad' => $unidad->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idVehiculo,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelVehiculo->findOrFail($idVehiculo->value())->update([
           'id_estado' => $idEstado->value(),
           'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idVehiculo,
    ): Vehiculo
    {
        $model = $this->eloquentModelVehiculo->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->findOrFail($idVehiculo->value());
        $OModel = new Vehiculo(
            new Id($model->id , false, 'El id del vehiculo no tiene el formato correcto'),
            new Text($model->placa, false, 7, 'La placa excede los 7 caracteres'),
            new Text($model->unidad, false, 10, 'La unidad excede los 10 caracteres'),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_marca, true, 'El id de la marca del vehiculo no tiene el formato correcto'),
            new Id($model->id_modelo, true, 'El id del modelo del vehiculo no tiene el formato correcto'),
            new Id($model->id_clase, true, 'El id de la clase del vehiculo no tiene el formato correcto'),
            new Id($model->id_flota, true, 'El id de la flota del vehiculo no tiene el formato correcto'),
            new Id($model->id_categoria, true, 'El id de la categoria del vehiculo no tiene el formato correcto'),
            new NumericInteger($model->id_estado->value),
            new NumericInteger($model->id_eliminado->value),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );

        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));

        return $OModel;
    }

}
