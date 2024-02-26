<?php

namespace Src\V2\IngresoCategoria\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\IngresoCategoria\Domain\IngresoCategoria;
use Src\V2\IngresoCategoria\Domain\IngresoCategoriaList;
use Src\V2\IngresoCategoria\Domain\IngresoCategoriaShortList;

interface IngresoCategoriaRepositoryContract
{
    public function create(
        Text $nombre,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByCliente(Id $idCliente): IngresoCategoriaList;
    public function listByCliente(Id $idCliente): IngresoCategoriaShortList;

    public function update(
        Id $id,
        Text $nombre,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idIngresoCategoria,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idIngresoCategoria,
    ): IngresoCategoria;
}
