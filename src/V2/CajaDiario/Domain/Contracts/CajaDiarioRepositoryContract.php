<?php

namespace Src\V2\CajaDiario\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\V2\Caja\Domain\CajaSede;

interface CajaDiarioRepositoryContract
{
    public function open(
        Id $idCaja,
        Id $idRuta,
        Id $idCliente,
        NumericFloat $montoInicial,
        DateTimeFormat $fechaApertura,
        Id $idUsuarioRegistro
    ): Id;

    public function close(
        Id $idCajaDiario,
        Id $idCaja,
        Id $idRuta,
        Id $idCliente,
        NumericFloat $montoFinal,
        DateTimeFormat $fechaCierre,
        Id $idUsuarioRegistro
    ): void;

    public function abrir(
        Id $idCaja,
        Id $idCliente,
        NumericFloat $monto,
        Id $idUsuarioRegistro
    ): string;

    public function cerrar(
        Id $idCaja,
        Id $idCliente,
        NumericFloat $monto,
        Id $idUsuarioRegistro
    ): void;

    public function montoActual(
        Id $idCaja,
        Id $idCliente
    ): CajaSede;

    public function cerrarCajaDespacho(
        Id $idCaja,
        Id $idCajaDiario,
        Id $idCliente,
        NumericFloat $monto,
        Id $idUsuarioRegistro
    ): void;


    public function reporte(
        Id $idCliente,
        DateFormat $fechaInicio,
        DateFormat $fechaFinal
    ): array;

    public function reporteSaldo(
        Id $idCliente,
        DateFormat $fechaInicio,
        DateFormat $fechaFinal,
        Id $idCaja
    ): array;
}
