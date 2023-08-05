<?php

namespace Src\V2\BoletoInterprovincial\Domain\Contracts;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
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
}
