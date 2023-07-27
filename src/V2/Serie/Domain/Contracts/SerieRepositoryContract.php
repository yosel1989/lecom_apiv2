<?php

namespace Src\V2\Serie\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Serie\Domain\Serie;

interface SerieRepositoryContract
{
    public function create(
        Text $nombre,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idTipoSerie,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByCliente(Id $idCliente): array;
    public function listByCliente(Id $idCliente): array;

    public function update(
        Id $id,
        Text $nombre,
        Id $idSede,
        NumericInteger $idTipoSerie,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idSerie,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idSerie,
    ): Serie;
}
