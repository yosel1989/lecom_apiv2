<?php

namespace App\Enums;

enum EnumTipoComprobante: int
{
    case Boleta = 1;
    case Factura = 2;
    case Ticket = 3;
    case NotaCredito = 4;
    case NotaDebito = 5;
    case TicketEgreso = 6;
    case ComprobanteIngreso = 7;
}
