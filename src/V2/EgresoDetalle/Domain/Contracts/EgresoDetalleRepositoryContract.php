<?php

namespace Src\V2\EgresoDetalle\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\EgresoDetalle\Domain\EgresoDetalle;
use Src\V2\EgresoDetalle\Domain\EgresoDetalleList;

interface EgresoDetalleRepositoryContract
{
    public function create(
        Id $id,
        Id $idEgreso,
        Id $idCliente,
        Id $idEgresoTipo,
        Text $detalle,
        DateFormat $fecha,
        NumericFloat $importe,
        NumericInteger $idMedioPago,
        Text $numeroDocumento,
        Id $idUsuarioRegistro
    ): EgresoDetalle;

    public function deleteByEgreso(
        Id $idEgreso
    ): void;

    public function collectionByCliente(Id $idCliente, Id $idEgreso): EgresoDetalleList;

    public function liquidarDetalle(
        Id $idCliente,
        Id $idLiquidacion,
        DateFormat $fechaDesde,
        DateFormat $fechaHasta,
        array $idVehiculos,
        Id $idUsuarioRegistro
    ): void;

    public function liberarLiquidacionDetalle(
        Id $idCliente,
        Id $idLiquidacion,
        Id $idUsuarioRegistro
    ): void;

    public function reporteByCliente(Id $idCliente, DateFormat $fechaDesde, DateFormat $fechaHasta, Id $idVehiculo, Id $idPersonal): EgresoDetalleList;

}
