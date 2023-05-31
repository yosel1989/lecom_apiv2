<?php

namespace Src\Administracion\Egreso\Domain\Contracts;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Egreso\Domain\Egreso;

interface EgresoRepositoryContract
{
    public function find(Id $id): ?Egreso;

    public function create(
        Id $id,
        DateOnlyFormat $fecha,
        Id $idTipoEgreso,
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
        Id $idTipoEgreso,
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
    public function liquidacionDiariaBus(DateOnlyFormat $fecha, Id $idCliente, Id $idVehiculo): array;
}
