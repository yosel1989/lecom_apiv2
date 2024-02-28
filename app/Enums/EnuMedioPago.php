<?php

namespace App\Enums;

enum EnuMedioPago: int{
case Efectivo = 1;
case TarjetaCredito = 2;
case Yape = 3;
case Cheque = 4;
case DepositoBancario = 5;
}
