<?php

namespace App\Enums;

enum IdTipoComprobante: int
{
    case Boleta = 1;
    case Factura = 2;
    case NotaCredito = 3;
    case NotaDebito = 4;
}
