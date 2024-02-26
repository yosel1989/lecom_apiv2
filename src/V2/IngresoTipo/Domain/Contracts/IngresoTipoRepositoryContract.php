<?php

namespace Src\V2\IngresoTipo\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\IngresoTipo\Domain\IngresoTipo;
use Src\V2\IngresoTipo\Domain\IngresoTipoList;
use Src\V2\IngresoTipo\Domain\IngresoTipoShortList;

interface IngresoTipoRepositoryContract
{
    public function create(
        Text $nombre,
        Id $idCliente,
        Id $idCategoria,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByCliente(Id $idCliente): IngresoTipoList;
    public function listByCliente(Id $idCliente): IngresoTipoShortList;
    public function listByClienteByCategoria(Id $idCliente, Id $idCategoria): IngresoTipoShortList;

    public function update(
        Id $id,
        Text $nombre,
        Id $idCategoria,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idIngresoTipo,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idIngresoTipo,
    ): IngresoTipo;
}
