<?php

namespace Src\V2\CajaDiario\Domain\Contracts;

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
        Id $idUsuarioRegistro,
    ): void;

    public function close(
        Id $idCaja,
        Id $idRuta,
        Id $idCliente,
        NumericFloat $montoFinal,
        DateTimeFormat $fechaCierre,
        Id $idUsuarioRegistro,
    ): void;
}
