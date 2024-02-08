<?php

namespace App\Enums;

enum EnumEstadoEgresoDetalle: int
{
    case Activo = 1;
    case Anulado = 2;
    case Liquidado = 3;
}
