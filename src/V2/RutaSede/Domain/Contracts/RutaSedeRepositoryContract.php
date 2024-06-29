<?php

namespace Src\V2\RutaSede\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;

interface RutaSedeRepositoryContract
{
    public function assign(
        Id $idCliente,
        Id $idRuta,
        array $sedes,
        Id $idUsuario
    ): void;

    public function collectionByClienteRuta(Id $idCliente, Id $idRuta): array;
}
