<?php

namespace Src\V2\BoletoInterprovincial\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialOficial;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialShortFechaList;
use Src\V2\Vehiculo\Domain\VehiculoShortList;

interface BoletoInterprovincialRepositoryContract
{

    public function collectionByCliente(Id $idCliente): array;
    public function reportByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idRuta, Id $idUsuario): array;
    public function reportByClienteGroupVehiculo(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idRuta, VehiculoShortList $vehiculos): array;
    public function reportByUsuarioCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idRuta, VehiculoShortList $vehiculos): array;
    public function reportePuntoVentaByCliente(Id $idCliente, Id $idUsuario, DateFormat $fecha): array;
    public function reporteTotalByClienteFecha(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): BoletoInterprovincialShortFechaList;
    public function reporteTotalByClienteFechaGroupVehiculo(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): BoletoInterprovincialShortFechaList;

    public function liquidacionTotalByVehiculoRangoFecha(Id $idCliente, array $idVehiculos, DateFormat $fechaDesde, DateFormat $fechaHasta): BoletoInterprovincialShortFechaList;
    public function liquidacionByVehiculoFechaGroupRutaBoleto(Id $idCliente, array $idVehiculos, DateFormat $fechaDesde, DateFormat $fechaHasta): array;

    public function changeState(
        Id $idBoletoInterprovincial,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idBoletoInterprovincial,
        Id $idCliente
    ): BoletoInterprovincialOficial;

    public function scanById(
        Id $idCliente,
        Id $idVehiculo,
        Id $idBoletoInterprovincial,
        Id $idUsuario
    ): void;

    public function traslateById(
        Id $idCliente,
        Id $idVehiculo,
        Id $idBoletoInterprovincial,
        Id $idUsuario,
        NumericInteger $idMotivo
    ): void;


    public function puntoVenta(
        Id $_id,

        Id $_idCliente,
        Id $_idSede,
        Id $_idCaja,
        Id $_idCajaDiario,
        NumericInteger $_idTipoDocumento,
        Text $_numeroDocumento,
        Text $_nombres,
        Text $_apellidos,
        NumericInteger $_menorEdad,


        Id $_idVehiculo,
        Id $_idAsiento,
        DateFormat $_fechaPartida,
        DateFormat $_horaPartida,
        Id $_idRuta,
        Id $_idBoletoPrecio,
        NumericFloat $_precio,
        NumericInteger $_idTipoMoneda,
        NumericInteger $_idFormaPago,
        NumericInteger $_idMedioPago,
        NumericInteger $_obsequio,

        NumericInteger $_idTipoComprobante,
        ValueBoolean $_editarEntidad,
        NumericInteger $_idTipoDocumentoEntidad,
        Text $_numeroDocumentoEntidad,
        Text $_nombreEntidad,
        Text $_direccionEntidad,

        Id $_idUsuarioRegistro


    ): BoletoInterprovincialOficial;



    public function reportTotalByCliente(
        Id $idCliente,
        Id $idUsuario,
        DateFormat $fechaDesde,
        DateFormat $fechaHasta,
        Id $idRuta,
        array $vehiculos
    ): array;

    public function reporteTotalByVehiculoRangoFecha(
        Id $idCliente,
        Id $idVehiculo,
        DateFormat $fechaDesde,
        DateFormat $fechaHasta
    ): array;

    public function reporteTotalByVehiculoFecha(
        Id $idCliente,
        Id $idVehiculo,
        DateFormat $fecha
    ): array;

    public function pasajerosByVehiculoRangoFecha(
        Id $idCliente,
        Id $idVehiculo,
        DateTimeFormat $fechaDesde,
        DateTimeFormat $fechaHasta
    ): array;

    public function liquidar(
        Id $idCliente,
        Id $idLiquidacion,
        DateFormat $fechaDesde,
        DateFormat $fechaHasta,
        array $idVehiculos
    ): void;

    public function liberarLiquidacion(
        Id $idCliente,
        Id $idLiquidacion
    ): void;
}
