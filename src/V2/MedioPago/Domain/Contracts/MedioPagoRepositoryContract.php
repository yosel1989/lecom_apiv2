<?php

namespace Src\V2\MedioPago\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\MedioPago\Domain\MedioPagoFlujo;
use Src\V2\MedioPago\Domain\MedioPagoShortList;

interface MedioPagoRepositoryContract
{
    public function collectionToDespacho(): MedioPagoShortList;
    public function collectionToCajaDiario(Id $idCliente, Id $idCajaDiario): MedioPagoShortList;
    public function flujoToCajaDiario(Id $idCliente, Id $idCajaDiario): MedioPagoFlujo;
}
