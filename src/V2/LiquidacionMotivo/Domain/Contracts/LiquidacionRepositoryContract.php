<?php

namespace Src\V2\LiquidacionMotivo\Domain\Contracts;

use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\LiquidacionMotivo\Domain\LiquidacionMotivoList;

interface LiquidacionRepositoryContract
{
    public function collectionByEstado(NumericInteger $idEstado): LiquidacionMotivoList;
}
