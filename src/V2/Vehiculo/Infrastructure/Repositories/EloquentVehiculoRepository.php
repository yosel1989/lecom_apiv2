<?php

declare(strict_types=1);

namespace Src\V2\Vehiculo\Infrastructure\Repositories;

use App\Models\Administracion\Vehiculo as EloquentModelVehiculo;
use http\Exception\InvalidArgumentException;
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

}
