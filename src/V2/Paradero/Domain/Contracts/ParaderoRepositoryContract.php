<?php

namespace Src\V2\Paradero\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Paradero\Domain\Paradero;

interface ParaderoRepositoryContract
{
    public function create(
        Text $nombre,
//        NumericFloat $precioBase,
        NumericFloat $latitud,
        NumericFloat $longitud,
        NumericInteger $idTipoRuta,
//        Id $idRuta,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByCliente(Id $idCliente): array;
    public function listByCliente(Id $idCliente): array;
    public function listByClienteByRuta(Id $idCliente, Id $idRuta): array;

    public function update(
        Id $id,
        Text $nombre,
//        NumericFloat $precioBase,
        NumericFloat $latitud,
        NumericFloat $longitud,
        NumericInteger $idTipoRuta,
//        Id $idRuta,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idParadero,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idParadero,
    ): Paradero;
}
