<?php

namespace App\Enums;

enum IdNivelUsuario: int
{
    case Super = 0;
    case Reseller = 1;
    case Cliente = 2;
}
