<?php

namespace App\Enums;

enum EnumSunatTipoIgv: int
{
    case GravadoOperacionOnerosa= 1;
    case GravadoRetiroPorPremio= 2;
    case GravadoRetiroPorDonacion= 3;
    case GravadoRetiro= 4;
    case GravadoRetiroPorPublicidad= 5;
    case GravadoBonificaciones= 6;
    case GravadoRetiroPorEntregaAtrabajadores= 7;
    case GravadoIVAP= 8;
    case ExoneradoOperacionOnerosa= 9;
    case ExoneradoTransferenciaGratuita= 10;
    case InafectoOperacionOnerosa= 11;
    case InafectoRetiroPorBonificacion= 12;
    case InafectoRetiro= 13;
    case InafectoRetiroPorMuestrasMedicas= 14;
    case InafectoRetiroPorConvenioColectivo= 15;
    case InafectoRetiroPorpremio= 16;
    case InafectoRetiroPorPublicidad= 17;
    case ExportacionDeBienesOservicios= 18;
}
