<?php

namespace Src\V2\Destino\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Destino\Domain\Destino;

interface DestinoRepositoryContract
{
    public function create(
        Text $nombre,
        NumericFloat $precioBase,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByCliente(Id $idCliente): array;
    public function listByCliente(Id $idCliente): array;

    public function update(
        Id $id,
        Text $nombre,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idDestino,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idDestino,
    ): Destino;
}
