<?php

namespace Src\V2\EgresoDetalle\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\V2\EgresoDetalle\Domain\EgresoDetalleList;

interface EgresoDetalleRepositoryContract
{
    public function create(
        Id $idEgreso,
        Id $idCliente,
        Id $idEgresoTipo,
        DateFormat $fecha,
        NumericFloat $importe,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByCliente(Id $idCliente, Id $idEgreso): EgresoDetalleList;

}
