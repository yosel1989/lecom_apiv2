<?php

namespace Src\V2\ClienteModuloMenu\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;

interface ClienteModuloMenuRepositoryContract
{
    public function assign(
        Id $idCliente,
        NumericInteger $idModulo,
        array $menu,
        Id $idUsuario
    ): void;

    public function collectionByCliente(Id $idCliente, NumericInteger $idModulo): array;

}
