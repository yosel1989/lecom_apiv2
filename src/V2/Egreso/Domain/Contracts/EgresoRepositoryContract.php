<?php

namespace Src\V2\Egreso\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Egreso\Domain\Egreso;
use Src\V2\Egreso\Domain\EgresoGroupTipoFechaShortList;
use Src\V2\Egreso\Domain\EgresoList;

interface EgresoRepositoryContract
{
    public function create(
        Id $id,
        NumericInteger $idOrigen,
        Id $idCliente,
        NumericInteger $idTipoComprobante,
//        Text $serie,
//        NumericInteger $numero,
        Id $idCategoria,
        Id $idTipo,
        Text $detalle,
        NumericInteger $idTipoDocumentoEntidad,
        Text $numeroDocumentoEntidad,
        Text $nombreEntidad,
        Id $idSede,
        NumericFloat $monto,
        NumericInteger $idMedioPago,
        Id $idVehiculo,
        Id $idPersonal,
        Id $idCaja,
        Id $idCajaDiario,
        DateFormat $fecha,
        Id $idUsuarioRegistro
    ): Egreso;

    public function delete(
        Id $id
    ): void;

    public function reporteByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idVehiculo, Id $idPersonal): EgresoList;

    public function reporteByClienteGroupTipoFecha(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): EgresoGroupTipoFechaShortList;

    public function reporteByClienteGroupTipoFechaVehiculo(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): EgresoGroupTipoFechaShortList;

    public function reporteDespachoByCliente(Id $idCliente, Id $idUsuario, DateFormat $fecha): EgresoList;

    public function find(
        Id $idEgreso,
    ): Egreso;

    public function findPdf(
        Id $idEgreso,
    ): Egreso;

    public function liquidacionTotalByVehiculoRangoFecha(Id $idCliente, array $idVehiculos, DateFormat $fechaDesde, DateFormat $fechaHasta): array;

    public function anular(
        Id $id,
        Id $idUsuarioRegistro
    ): void;
}
