<?php

namespace Src\V2\BoletoInterprovincial\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
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
        Id $_idCliente,
        Id $_idSede,
        Id $_idRuta,
        Id $_idParadero,
        NumericFloat $_precio,
        NumericInteger $_idTipoDocumento,
        Text $_numeroDocumento,
        Text $_nombre,
        Text $_direccion,
        Id $idUsuario
    ): void;
}
