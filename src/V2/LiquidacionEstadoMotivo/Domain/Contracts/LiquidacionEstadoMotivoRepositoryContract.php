<?php

namespace Src\V2\LiquidacionEstadoMotivo\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\LiquidacionEstadoMotivo\Domain\LiquidacionEstadoMotivoList;

interface LiquidacionEstadoMotivoRepositoryContract
{
    public function create(
        Id $idCliente,
        Id $idLiquidacion,
        NumericInteger $idLiquidacionMotivo,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByLiquidacion(Id $idLiquidacion): LiquidacionEstadoMotivoList;
}
