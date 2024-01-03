<?php

namespace Src\V2\PerfilModuloMenu\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;

interface PerfilModuloMenuRepositoryContract
{
    public function assign(
        Id $idCliente,
        Id $idPerfil,
        NumericInteger $idModulo,
        array $menu,
        Id $idUsuario
    ): void;

    public function collectionByClientePerfil(Id $idCliente, Id $idPerfil, NumericInteger $idModulo): array;
}
