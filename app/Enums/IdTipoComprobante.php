<?php

namespace App\Enums;

enum IdTipoComprobante: int
{
    case Boleta = 1;
    case Factura = 2;
    case Ticket = 3;
    case NotaCredito = 4;
    case NotaDebito = 5;
}
