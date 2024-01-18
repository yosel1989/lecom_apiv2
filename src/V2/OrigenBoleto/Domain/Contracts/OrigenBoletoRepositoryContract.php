<?php

namespace Src\V2\OrigenBoleto\Domain\Contracts;

use Src\V2\OrigenBoleto\Domain\OrigenBoletoShortList;

interface OrigenBoletoRepositoryContract
{
    public function list(): OrigenBoletoShortList;
}
