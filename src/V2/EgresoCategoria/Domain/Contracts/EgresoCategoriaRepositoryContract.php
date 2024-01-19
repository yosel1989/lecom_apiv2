<?php

namespace Src\V2\EgresoCategoria\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\EgresoCategoria\Domain\EgresoCategoria;
use Src\V2\EgresoCategoria\Domain\EgresoCategoriaList;
use Src\V2\EgresoCategoria\Domain\EgresoCategoriaShortList;

interface EgresoCategoriaRepositoryContract
{
    public function create(
        Text $nombre,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByCliente(Id $idCliente): EgresoCategoriaList;
    public function listByCliente(Id $idCliente): EgresoCategoriaShortList;

    public function update(
        Id $id,
        Text $nombre,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idEgresoCategoria,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idEgresoCategoria,
    ): EgresoCategoria;
}
