<?php

namespace Src\V2\CajaTraslado\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\CajaTraslado\Domain\CajaTraslado;
use Src\V2\CajaTraslado\Domain\CajaTrasladoGroupTipoFechaShortList;
use Src\V2\CajaTraslado\Domain\CajaTrasladoList;

interface CajaTrasladoRepositoryContract
{
    public function create(
        Id $id,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idTipoComprobante,
        Id $idPersonal,
        Id $idCajaOrigen,
        Id $idCajaOrigenDestino,
        NumericFloat $monto,
        Id $idUsuarioRegistro
    ): CajaTraslado;

    public function delete(
        Id $id
    ): void;

    public function reporteByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): CajaTrasladoList;

    public function reporteByClienteGroupTipoFecha(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): CajaTrasladoGroupTipoFechaShortList;

    public function reporteByClienteGroupTipoFechaVehiculo(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): CajaTrasladoGroupTipoFechaShortList;

    public function reporteByUsuario(Id $idCliente, Id $idUsuario, DateFormat $fecha): CajaTrasladoList;

    public function find(
        Id $idCajaTraslado,
    ): CajaTraslado;

    public function findPdf(
        Id $idCajaTraslado,
    ): CajaTraslado;

    public function liquidacionTotalByVehiculoRangoFecha(Id $idCliente, array $idVehiculos, DateFormat $fechaDesde, DateFormat $fechaHasta): array;

    public function anular(
        Id $id,
        Id $idUsuarioRegistro
    ): void;
}
