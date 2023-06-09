<?php

namespace Src\V2\Vehiculo\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Vehiculo\Domain\Vehiculo;

interface VehiculoRepositoryContract
{
    public function create(
        Text $placa,
        Text $unidad,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;
    public function collectionByCliente(Id $idCliente): array;

    public function update(
        Id $id,
        Text $placa,
        Text $unidad,
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
