<?php

namespace App\Enums;

enum IdTipoDocumento: int
{
    case Dni = 1;
    case Ruc = 2;
    case CarnetExtranjeria = 3;
    case Pasaporte = 4;
}
