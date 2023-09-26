<?php

namespace Src\V2\BoletoInterprovincial\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\TimeFormat;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincial;

interface BoletoInterprovincialRepositoryContract
{

    public function collectionByCliente(Id $idCliente): array;
    public function reportByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta): array;
    public function reportePuntoVentaByCliente(Id $idCliente, Id $idSede, DateFormat $fecha): array;

    public function changeState(
        Id $idBoletoInterprovincial,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idBoletoInterprovincial,
    ): BoletoInterprovincial;


    public function puntoVenta(
        Id $_idCaja,
        Id $_idCliente,
        Id $_idSede,

        Text $_tipoDocumentoPasajeroValor,
        NumericInteger $_tipoDocumentoPasajero,
        Text $_numeroDocumentoPasajero,
        Text $_nombrePasajero,
        Text $_apellidoPasajero,

        NumericInteger $_menorEdad,
        Id $_idVehiculo,
        Text $_placaVehiculo,
        Id $_idAsiento,
        DateFormat $_fechaPartida,
        TimeFormat $_horaPartida,
        Id $_idRuta,
        Id $_idParadero,
        NumericFloat $_precio,

        NumericInteger $_idTipoMoneda,
        Text $_tipoMonedaValor,

        NumericInteger $_idFormaPago,
        Text $_formaPagoValor,

        NumericInteger $_obsequio,
        NumericFloat $_pago,
        NumericFloat $_vuelto,

        NumericInteger $_idTipoComprobante,


    ): void;
}
