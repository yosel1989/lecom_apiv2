<?php

namespace App\Enums;

enum EnumTipoPago: int
{
    case Efectivo = 1;
    case TarjetaCredito = 2;
}
