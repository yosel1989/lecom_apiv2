<?php

namespace Src\V2\EgresoMotivo\Domain\Contracts;

use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\EgresoMotivo\Domain\EgresoMotivoList;

interface EgresoRepositoryContract
{
    public function collectionByEstado(NumericInteger $idEstado): EgresoMotivoList;
}
