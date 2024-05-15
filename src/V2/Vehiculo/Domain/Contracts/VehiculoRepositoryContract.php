<?php

namespace Src\V2\Vehiculo\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Vehiculo\Domain\Vehiculo;
use Src\V2\Vehiculo\Domain\VehiculoShortList;

interface VehiculoRepositoryContract
{
    public function create(
        Text $placa,
        Text $unidad,
        Id $idCliente,
        NumericInteger $numAsientos,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;
    public function collectionByCliente(Id $idCliente): array;
    public function listByClienteArray(Id $idCliente, array $idVehiculos): VehiculoShortList;
    public function listByCliente(Id $idCliente): array;
    public function listByUsuario(Id $idUsuario, Id $idCliente): VehiculoShortList;
    public function collectionByUsuario(Id $idUsuario): array;
    public function asignarUsuario(Id $idUsuario, Text $vehiculos, Id $idUsuarioRegistro): void;

    public function update(
        Id $id,
        Text $placa,
        Text $unidad,
        NumericInteger $numAsientos,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idVehiculo,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idVehiculo,
    ): Vehiculo;
}
