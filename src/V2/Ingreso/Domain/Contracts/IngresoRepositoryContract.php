<?php

namespace Src\V2\Ingreso\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\Ingreso\Domain\Ingreso;
interface IngresoRepositoryContract
{
    public function create(
        Id $id,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idTipoComprobante,
        Id $idTipoIngreso,
        Text $detalle,
        NumericInteger $idTipoDocumentoEntidad,
        Text $numeroDocumentoEntidad,
        Text $nombreEntidad,
        NumericFloat $importe,
        Id $idCaja,
        Id $idCajaDiario,
        ValueBoolean $contabilizado,
        ValueBoolean $aprobado,
        NumericInteger $idMedioPago,
        Text $numeroOperacion,
        NumericInteger $idEntidadFinanciera,
        Id $idUsuarioRegistro
    ): Ingreso;

//    public function delete(
//        Id $id
//    ): void;
//
//    public function reporteByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idVehiculo, Id $idPersonal): IngresoList;
//
//    public function reporteByClienteGroupTipoFecha(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): IngresoGroupTipoFechaShortList;
//
//    public function reporteByClienteGroupTipoFechaVehiculo(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): IngresoGroupTipoFechaShortList;
//
//    public function reporteDespachoByCliente(Id $idCliente, Id $idUsuario, DateFormat $fecha): IngresoList;

    public function find(
        Id $idIngreso,
    ): Ingreso;
//
//    public function liquidacionTotalByVehiculoRangoFecha(Id $idCliente, array $idVehiculos, DateFormat $fechaDesde, DateFormat $fechaHasta): array;

    public function anular(
        Id $id,
        Id $idUsuarioRegistro
    ): void;
}
