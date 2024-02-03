<?php

namespace App\Enums;

enum EnumEstadoBoletoInterprovincial: int
{
    case Activo = 1;
    case Anulado = 2;
    case Liquidado = 3;
}
