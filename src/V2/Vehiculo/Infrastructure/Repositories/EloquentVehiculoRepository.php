<?php

declare(strict_types=1);

namespace Src\V2\Vehiculo\Infrastructure\Repositories;

use App\Models\Administracion\Vehiculo as EloquentModelVehiculo;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Vehiculo\Domain\Contracts\VehiculoRepositoryContract;
use Src\V2\Vehiculo\Domain\Vehiculo;

final class EloquentVehiculoRepository implements VehiculoRepositoryContract
{
    private EloquentModelVehiculo $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelVehiculo = new EloquentModelVehiculo;
    }



    public function collectionByCliente(Id $idCliente): array
    {
        $vehicles = $this->eloquentModelVehiculo->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $vehicles as $vehiculo ){

            $OVehicle = new Vehiculo(
                new Id($vehiculo->id , false, 'El id del vehiculo no tiene el formato correcto'),
                new Text($vehiculo->placa, false, 7, 'La placa excede los 7 caracteres'),
                new Text($vehiculo->unidad, false, 10, 'La unidad excede los 10 caracteres'),
                new Id($vehiculo->idCliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($vehiculo->idMarca, true, 'El id de la marca del vehiculo no tiene el formato correcto'),
                new Id($vehiculo->idModelo, true, 'El id del modelo del vehiculo no tiene el formato correcto'),
                new Id($vehiculo->idClase, true, 'El id de la clase del vehiculo no tiene el formato correcto'),
                new Id($vehiculo->idFlota, true, 'El id de la flota del vehiculo no tiene el formato correcto'),
                new Id($vehiculo->idCategoria, true, 'El id de la categoria del vehiculo no tiene el formato correcto'),
                new NumericInteger($vehiculo->idEstado->value),
                new NumericInteger($vehiculo->idEliminado->value),
                new Id($vehiculo->idUsurioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($vehiculo->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($vehiculo->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($vehiculo->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OVehicle->setUsuarioRegistro(new Text(""));
            $OVehicle->setUsuarioModifico(new Text(""));

            $arrVehicles[] = $OVehicle;
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
        $model = $this->eloquentModelVehiculo->findOrFail($idVehiculo->value());
        $OVehicle = new Vehiculo(
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
            new Id($model->idUsurioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );

        return $OVehicle;
    }

}
