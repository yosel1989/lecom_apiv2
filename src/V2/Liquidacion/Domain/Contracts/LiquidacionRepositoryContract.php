<?php

namespace Src\V2\Liquidacion\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\Liquidacion\Domain\Liquidacion;
use Src\V2\Liquidacion\Domain\LiquidacionList;

interface LiquidacionRepositoryContract
{
    public function create(
        Id $_id,
        NumericInteger $_codigo,
        Id $_idCliente,
        Id $_idSede,
        array $_idVehiculos,
        Id $_idPersonal,
        DateFormat $_fechaInicio,
        DateFormat $_fechaFin,
        Text $_archivo,
        Text $_urlArchivo,
//        NumericInteger $_idEstado,
        Id $_idUsuarioRegistro,
        ValueBoolean $_local,
        NumericFloat $monto
    ): void;

    public function delete(
        Id $id
    ): void;

    public function find(
        Id $idLiquidacion,
    ): Liquidacion;

    public function collectionByCliente(Id $idCliente, DateFormat $fechaInicio, DateFormat $fechaFin): LiquidacionList;

    public function ultimoCodigoLiquidacion(
        Id $idCliente,
    ): NumericInteger;

    public function anular(
        Id $id,
        Id $idUsuarioRegistro
    ): void;

}
