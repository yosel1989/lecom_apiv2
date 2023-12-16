<?php

namespace Src\V2\PerfilModulo\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;

interface PerfilModuloRepositoryContract
{
    public function assign(
        Id $idCliente,
        Id $idPerfil,
        array $modulos,
        Id $idUsuario
    ): void;

    public function collectionByClientePerfil(Id $idCliente, Id $idPerfil): array;
}
