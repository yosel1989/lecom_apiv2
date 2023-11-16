<?php

namespace Src\V2\ClienteConfiguracion\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\ClienteConfiguracion\Domain\ClienteConfiguracion;

interface ClienteConfiguracionRepositoryContract
{

    public function find(
        Id $idCliente,
    ): ClienteConfiguracion;
}
