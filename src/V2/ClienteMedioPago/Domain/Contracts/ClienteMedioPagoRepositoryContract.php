<?php

namespace Src\V2\ClienteMedioPago\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\ValueBoolean;

interface ClienteMedioPagoRepositoryContract
{
    public function collectionByCliente(Id $idCliente): array;

    public function changeState(
        Id $idCliente,
        NumericInteger $idMedioPago,
        ValueBoolean $idEstado,
        Id $idUsuarioModifico
    ): void;
}
