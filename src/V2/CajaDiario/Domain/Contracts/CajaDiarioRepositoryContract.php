<?php

namespace Src\V2\CajaDiario\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;

interface CajaDiarioRepositoryContract
{
    public function open(
        Id $idCaja,
        Id $idRuta,
        Id $idCliente,
        NumericFloat $montoInicial,
        DateTimeFormat $fechaApertura,
        Id $idUsuarioRegistro
    ): void;

    public function close(
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
        DateFormat $fechaFinal
    ): array;
}
