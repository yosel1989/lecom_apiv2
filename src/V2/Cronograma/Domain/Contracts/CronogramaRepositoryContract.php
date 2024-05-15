<?php

namespace Src\V2\Cronograma\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\Cronograma\Domain\Cronograma;
use Src\V2\Cronograma\Domain\CronogramaGroupTipoFechaShortList;
use Src\V2\Cronograma\Domain\CronogramaList;

interface CronogramaRepositoryContract
{
    public function create(
        Id $idCliente,
        Id $idSede,
        NumericInteger $idTipoRuta,
        Id $idRuta,
        DateFormat $fecha,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function delete(
        Id $id
    ): void;

    public function reporteByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idVehiculo, Id $idPersonal): CronogramaList;

    public function collectionByCliente(Id $idCliente): CronogramaList;

    public function reporteByClienteGroupTipoFecha(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): CronogramaGroupTipoFechaShortList;

    public function reporteByClienteGroupTipoFechaVehiculo(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): CronogramaGroupTipoFechaShortList;

    public function reporteDespachoByCliente(Id $idCliente, Id $idUsuario, DateFormat $fecha): CronogramaList;

    public function find(
        Id $idCronograma,
    ): Cronograma;

    public function findPdf(
        Id $idCronograma,
    ): Cronograma;

    public function liquidacionTotalByVehiculoRangoFecha(Id $idCliente, array $idVehiculos, DateFormat $fechaDesde, DateFormat $fechaHasta): array;

    public function anular(
        Id $id,
        Id $idUsuarioRegistro
    ): void;
}
