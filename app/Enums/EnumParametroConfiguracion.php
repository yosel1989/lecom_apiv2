<?php

namespace App\Enums;

enum EnumParametroConfiguracion: int
{
    case NumeroComprobantesDiarios = 1;
    case Empresa_Ruc = 2;
    case Empresa_RazonSocial = 3;
    case Empresa_DireccionFiscal = 4;
    case Empresa_Ubigeo = 5;
}
