<?php

namespace Src\V2\LogBoletoInterprovincial\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\LogBoletoInterprovincial\Domain\LogBoletoInterprovincialList;

interface LogBoletoInterprovincialRepositoryContract
{
    public function collectionByCliente(Id $idCliente): LogBoletoInterprovincialList;
}
