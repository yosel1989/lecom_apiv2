<?php

namespace App\Enums;

enum EnumEstadoEgreso: int
{
    case Activo = 1;
    case Anulado = 2;
    case Liquidado = 3;
}
