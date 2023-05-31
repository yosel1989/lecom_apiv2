<?php

namespace Src\TransportePersonal\Reporte\Domain\Contracts;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;

interface ReporteRepositoryContract
{

    public function reportByClient(
        Id $idCliente,
        DateOnlyFormat $fechaDesde,
        DateOnlyFormat $fechaHasta
    ): array;

}
