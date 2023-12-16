<?php

namespace Src\V2\Ruta\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Ruta\Domain\Ruta;

interface RutaRepositoryContract
{
    public function create(
        Text $nombre,
        NumericInteger $idTipo,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByCliente(Id $idCliente): array;
    public function listByCliente(Id $idCliente): array;
    public function listByTipo(NumericInteger $idTipoRuta, Id $idCliente): array;

    public function update(
        Id $id,
        Text $nombre,
        NumericInteger $idTipo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idRuta,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idRuta,
    ): Ruta;
}
