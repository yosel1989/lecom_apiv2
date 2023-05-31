<?php

namespace Src\Administracion\Ingreso\Domain\Contracts;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Ingreso\Domain\Ingreso;

interface IngresoRepositoryContract
{
    public function find(Id $id): ?Ingreso;

    public function create(
        Id $id,
        DateOnlyFormat $fecha,
        Id $idTipoIngreso,
        Id $idVehiculo,
        Id $idPersonal,
        Id $idRuta,
        Numeric $monto,
        Text $observacion,
        Id $idCliente,
        Numeric $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function update(
        Id $id,
        DateOnlyFormat $fecha,
        Id $idTipoIngreso,
        Id $idVehiculo,
        Id $idPersonal,
        Id $idRuta,
        Numeric $monto,
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
    public function collectionByClientByDate(Id $idCliente, DateOnlyFormat $fecha): array;
    public function report(DateOnlyFormat $fechaDesde, DateOnlyFormat $fechaHasta, Id $idVehiculo, Id $idCliente): array;
}
