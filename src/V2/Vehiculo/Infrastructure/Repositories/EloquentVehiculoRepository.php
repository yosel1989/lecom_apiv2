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
        $vehicles = $this->eloquentModelVehiculo->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos')->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $vehicles as $model ){

            $OModel = new Vehiculo(
                new Id($model->id , false, 'El id del vehiculo no tiene el formato correcto'),
                new Text($model->placa, false, 7, 'La placa excede los 7 caracteres'),
                new Text($model->unidad, false, 10, 'La unidad excede los 10 caracteres'),
                new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->idMarca, true, 'El id de la marca del vehiculo no tiene el formato correcto'),
                new Id($model->idModelo, true, 'El id del modelo del vehiculo no tiene el formato correcto'),
                new Id($model->idClase, true, 'El id de la clase del vehiculo no tiene el formato correcto'),
                new Id($model->idFlota, true, 'El id de la flota del vehiculo no tiene el formato correcto'),
                new Id($model->idCategoria, true, 'El id de la categoria del vehiculo no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value),
                new NumericInteger($model->idEliminado->value),
                new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
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
        $vehicles = $this->eloquentModelVehiculo->where('idCliente',$idCliente->value())->get();

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
        $relation = $this->eloquentUserVehicleModel->with('usuarioRegistro:id,nombres,apellidos','usuarioModifico:id,nombres,apellidos')
            ->where('idUsuario',$idUsuario->value())->get();

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
                    new Id($relation->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                    new Id($relation->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                    new DateTimeFormat($relation->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                    new DateTimeFormat($relation->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
                );
            }else{
                $OModel = new UsuarioVehiculo(
                    new Text($model->id , false, -1),
                    new Text($model->placa, false, -1, ''),
                    new Text($model->unidad, false, -1, ''),
                    new Id($relation->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                    new Id($relation->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                    new DateTimeFormat($relation->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                    new DateTimeFormat($relation->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
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

        $relacion = $this->eloquentUserVehicleModel->where('idUsuario', $idUsuario->value())->get();
        if(!$relacion->isEmpty()){
            $this->eloquentUserVehicleModel->findOrFail($relacion->first()->id)->update([
                'vehiculos' => $vehiculos->value(),
                'idUsuarioModifico' => $idUsuarioRegistro->value(),
            ]);
        }else{
            $this->eloquentUserVehicleModel->create([
                'idUsuario' => $idUsuario->value(),
                'vehiculos' => $vehiculos->value(),
                'idUsuarioRegistro' => $idUsuarioRegistro->value(),
                'idUsuarioModifico' => $idUsuarioRegistro->value(),
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
        $count = DB::table('vehiculos')->count();
        $this->eloquentModelVehiculo->create([
           'placa' => $placa->value(),
           'codigo' => ($count + 1) ,
           'unidad' => $unidad->value(),
           'idCliente' => $idCliente->value(),
           'idEstado' => $idEstado->value(),
           'idUsuarioRegistro' => $idUsuarioRegistro->value()
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
        $this->eloquentModelVehiculo->findOrFail($id->value())->update([
            'placa' => $placa->value(),
            'unidad' => $unidad->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idVehiculo,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelVehiculo->findOrFail($idVehiculo->value())->update([
           'idEstado' => $idEstado->value(),
           'idUsuarioModifico' => $idUsuarioModifico->value()
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
            new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->idMarca, true, 'El id de la marca del vehiculo no tiene el formato correcto'),
            new Id($model->idModelo, true, 'El id del modelo del vehiculo no tiene el formato correcto'),
            new Id($model->idClase, true, 'El id de la clase del vehiculo no tiene el formato correcto'),
            new Id($model->idFlota, true, 'El id de la flota del vehiculo no tiene el formato correcto'),
            new Id($model->idCategoria, true, 'El id de la categoria del vehiculo no tiene el formato correcto'),
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
