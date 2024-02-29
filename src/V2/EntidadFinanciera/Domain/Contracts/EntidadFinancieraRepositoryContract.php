<?php

namespace Src\V2\EntidadFinanciera\Domain\Contracts;

use Src\V2\EntidadFinanciera\Domain\EntidadFinancieraList;

interface EntidadFinancieraRepositoryContract
{
    public function list(): EntidadFinancieraList;
}
