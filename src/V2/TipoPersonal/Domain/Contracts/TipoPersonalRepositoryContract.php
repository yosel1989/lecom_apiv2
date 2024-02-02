<?php

namespace Src\V2\TipoPersonal\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\TipoPersonal\Domain\TipoPersonal;
use Src\V2\TipoPersonal\Domain\TipoPersonalList;
use Src\V2\TipoPersonal\Domain\TipoPersonalShortList;

interface TipoPersonalRepositoryContract
{
    public function create(
        Id $idCliente,
        Text $nombre,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function update(
        Id $id,
        Id $idCliente,
        Text $nombre,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $id,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $id,
    ): TipoPersonal;

    public function collectionByCliente(Id $idCliente): TipoPersonalList;
    public function listByCliente(Id $idCliente): TipoPersonalShortList;
}
