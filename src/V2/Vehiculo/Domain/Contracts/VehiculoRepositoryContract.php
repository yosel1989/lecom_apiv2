<?php

namespace Src\V2\Vehiculo\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;

interface VehiculoRepositoryContract
{
    public function collectionByCliente(Id $idCliente): array;
}
