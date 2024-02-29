<?php

namespace Src\V2\MedioPago\Domain\Contracts;

use Src\V2\MedioPago\Domain\MedioPagoShortList;

interface MedioPagoRepositoryContract
{
    public function collectionToDespacho(): MedioPagoShortList;
}
