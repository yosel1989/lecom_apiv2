<?php

namespace Src\V2\BoletoPrecio\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\BoletoPrecio\Domain\BoletoPrecio;

interface BoletoPrecioRepositoryContract
{
    public function create(
        Id $idCliente,
        NumericInteger $idTipoRuta,
        Id $idRuta,
        Id $idParaderoOrigen,
        Id $idParaderoDestino,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function update(
        Id $id,
        Id $idParaderoOrigen,
        Id $idParaderoDestino,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByCliente(Id $idCliente, Id $idRuta): array;
    public function listByCliente(Id $idCliente): array;
    public function listByClienteByRuta(Id $idCliente, Id $idRuta): array;


    public function changeState(
        Id $idBoletoPrecio,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idBoletoPrecio,
    ): BoletoPrecio;
}
