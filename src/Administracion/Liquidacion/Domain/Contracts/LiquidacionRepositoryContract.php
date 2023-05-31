<?php

namespace Src\Administracion\Liquidacion\Domain\Contracts;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;

interface LiquidacionRepositoryContract
{
//    public function find(Id $id): ?Liquidacion;

    public function create(
        Id $id,
        Numeric $IdTipoLiquidacion,
        DateOnlyFormat $fecha,
        DateOnlyFormat $fechaDesde,
        DateOnlyFormat $fechaHasta,
        Id $idVehiculo,
        Id $idPersonal,
        Text $observacion,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void;


    public function cancel(
        Id $id,
        Id $idMotivo,
        Text $detalle,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByClient(Id $idCliente): array;
    public function collectionByClientByDateRange(Id $idCliente, DateOnlyFormat $fecha, DateOnlyFormat $fechaHasta): array;
}
