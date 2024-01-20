<?php

namespace Src\V2\ClienteModulo\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;

interface ClienteModuloRepositoryContract
{
    public function assign(
        Id $idCliente,
        array $modulos,
        Id $idUsuario
    ): void;

}
