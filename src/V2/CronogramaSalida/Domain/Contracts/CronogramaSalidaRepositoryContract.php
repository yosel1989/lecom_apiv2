<?php

namespace Src\V2\CronogramaSalida\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\TimeFormat;
use Src\V2\CronogramaSalida\Domain\CronogramaSalida;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaGroupTipoFechaShortList;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaList;

interface CronogramaSalidaRepositoryContract
{
    public function create(
        Id $idCliente,
        Id $idCronograma,
        Id $idVehiculo,
        DateFormat $fecha,
        TimeFormat $hora,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;


    public function update(
        Id $id,
        Id $idCliente,
        Id $idCronograma,
        Id $idVehiculo,
        DateFormat $fecha,
        TimeFormat $hora,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idCronogramaSalida,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function delete(
        Id $id
    ): void;

    public function reporteByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idVehiculo, Id $idPersonal): CronogramaSalidaList;

    public function collectionByCliente(Id $idCliente): CronogramaSalidaList;

    public function collectionByCronograma(Id $idCronograma): CronogramaSalidaList;

    public function collectionByRuta(Id $idRuta): CronogramaSalidaList;

    public function asientosDisponibles(Id $idCliente, Id $idCronogramaSalida): NumericInteger;

    public function reporteByClienteGroupTipoFecha(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): CronogramaSalidaGroupTipoFechaShortList;

    public function reporteByClienteGroupTipoFechaVehiculo(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): CronogramaSalidaGroupTipoFechaShortList;

    public function reporteDespachoByCliente(Id $idCliente, Id $idUsuario, DateFormat $fecha): CronogramaSalidaList;

    public function find(
        Id $idCronogramaSalida,
    ): CronogramaSalida;

    public function findPdf(
        Id $idCronogramaSalida,
    ): CronogramaSalida;

    public function liquidacionTotalByVehiculoRangoFecha(Id $idCliente, array $idVehiculos, DateFormat $fechaDesde, DateFormat $fechaHasta): array;

    public function anular(
        Id $id,
        Id $idUsuarioRegistro
    ): void;
}
