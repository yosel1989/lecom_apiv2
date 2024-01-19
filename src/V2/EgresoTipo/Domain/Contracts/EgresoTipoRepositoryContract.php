<?php

namespace Src\V2\EgresoTipo\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\EgresoTipo\Domain\EgresoTipo;
use Src\V2\EgresoTipo\Domain\EgresoTipoList;
use Src\V2\EgresoTipo\Domain\EgresoTipoShortList;

interface EgresoTipoRepositoryContract
{
    public function create(
        Text $nombre,
        Id $idCliente,
        Id $idCategoria,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByCliente(Id $idCliente): EgresoTipoList;
    public function listByCliente(Id $idCliente): EgresoTipoShortList;

    public function update(
        Id $id,
        Text $nombre,
        Id $idCategoria,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idEgresoTipo,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idEgresoTipo,
    ): EgresoTipo;
}
