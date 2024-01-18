<?php

namespace Src\V2\BoletoInterprovincial\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialOficial;
use Src\V2\Vehiculo\Domain\VehiculoShortList;

interface BoletoInterprovincialRepositoryContract
{

    public function collectionByCliente(Id $idCliente): array;
    public function reportByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idRuta, Id $idUsuario): array;
    public function reportByUsuarioCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idRuta, VehiculoShortList $vehiculos): array;
    public function reportePuntoVentaByCliente(Id $idCliente, Id $idUsuario, DateFormat $fecha): array;

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
        NumericInteger $_obsequio,

        NumericInteger $_idTipoComprobante,
        NumericInteger $_idTipoDocumentoEntidad,
        Text $_numeroDocumentoEntidad,
        Text $_nombreEntidad,
        Text $_direccionEntidad,

        Id $_idUsuarioRegistro


    ): BoletoInterprovincialOficial;
}
