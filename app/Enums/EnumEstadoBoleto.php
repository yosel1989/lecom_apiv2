<?php

namespace App\Enums;

enum EnumEstadoBoleto: int
{
    case Inactivo = 0;
    case Activo = 1;
    case Anulado = 2;
}
