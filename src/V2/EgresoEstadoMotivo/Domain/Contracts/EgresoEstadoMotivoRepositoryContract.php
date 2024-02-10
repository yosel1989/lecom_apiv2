<?php

namespace Src\V2\EgresoEstadoMotivo\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\EgresoEstadoMotivo\Domain\EgresoEstadoMotivoList;

interface EgresoEstadoMotivoRepositoryContract
{
    public function create(
        Id $idCliente,
        Id $idEgreso,
        NumericInteger $idEgresoMotivo,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByEgreso(Id $idEgreso): EgresoEstadoMotivoList;
}
