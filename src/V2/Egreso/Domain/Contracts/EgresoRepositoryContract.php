<?php

namespace Src\V2\Egreso\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\ModelBase\Domain\ValueObjects\DateFormat;
use Src\V2\Egreso\Domain\Egreso;
use Src\V2\Egreso\Domain\EgresoList;

interface EgresoRepositoryContract
{
    public function create(
        Id $idEgreso,
        Id $idCliente,
        Id $idEgresoTipo,
        DateTimeFormat $fecha,
        array $detalle,
        NumericFloat $total,
        Id $idUsuarioRegistro,
    ): void;

    public function collectionByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idVehiculo, Id $idPersonal): EgresoList;

    public function find(
        Id $idEgreso,
    ): Egreso;
}
