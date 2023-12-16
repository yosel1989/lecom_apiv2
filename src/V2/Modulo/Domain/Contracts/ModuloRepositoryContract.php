<?php

namespace Src\V2\Modulo\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Modulo\Domain\Modulo;

interface ModuloRepositoryContract
{
    public function create(
        Text $nombre,
        Text $link,
        Text $icono,
        Text $codigo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collection(): array;
    public function list(): array;
    public function listToPerfil(Id $idPerfil): array;
    public function listToUsuarioPerfil(Id $idPerfil): array;

    public function update(
        Id $id,
        Text $nombre,
        Text $link,
        Text $icono,
        Text $codigo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idModulo,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idModulo,
    ): Modulo;
}
