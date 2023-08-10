<?php

declare(strict_types=1);

namespace Src\V2\Vehiculo\Infrastructure\Repositories;

use App\Models\V2\Vehiculo as EloquentModelVehiculo;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Vehiculo\Domain\Contracts\VehiculoRepositoryContract;
use Src\V2\Vehiculo\Domain\Vehiculo;
use Src\V2\Vehiculo\Domain\VehiculoList;

final class EloquentVehiculoRepository implements VehiculoRepositoryContract
{
    private EloquentModelVehiculo $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelVehiculo = new EloquentModelVehiculo;
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
        $vehicles = $this->eloquentModelVehiculo->select(
            'id',
            'placa',
            'unidad'
        )->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $vehicles as $model ){

            $OModel = new VehiculoList(
                new Id($model->id , false, 'El id del vehiculo no tiene el formato correcto'),
                new Text($model->placa, false, 7, 'La placa excede los 7 caracteres'),
                new Text($model->unidad, false, 10, 'La unidad excede los 10 caracteres')
            );
            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
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
