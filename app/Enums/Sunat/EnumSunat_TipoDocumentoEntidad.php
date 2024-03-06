<?php

namespace App\Enums\Sunat;

enum EnumSunat_TipoDocumentoEntidad: string
{
    case Cedular_de_Identificacion = '0'; //CED
    case Libreta_Electoral = '02'; //L.E
    case Documento_Nacional_de_Identidad = '03'; //DNI
    case Registro_Unico_de_Contribuyente = '04'; //RUC
    case Carnet_de_Identidad_Policical = '05'; //CIP;
    case Pasaporte = '06'; //PAS;
    case Carnet_de_Extranjeria = '07'; //CEX
    case Organizaciones_Internacionales = '08'; //ORG
    case Salvoconducto = '09'; //SAL
    case Libreta_Militar = '10'; //L.M
    case Partida_de_Nacimiento = '11'; //PAR
    case Licencia_de_Conducir = '12'; //LIC
    case CI_Diplomaticos = '13'; //DIP
    case Codigo_Aduanero_de_Transportista_Terrestre = '14';
    case Carnet_de_Fuerzas_Armadas = '16'; //CFFAA
    case Cedula_de_Ciudadania = '17';
    case Libreta_de_Tripulante_Terrestre = '18';
    case Codigo_Aduanero_Centro_Control_Fronterizo = '19';
    case Registro_Tributario_Extranjero = '20';
    case CUIT_Chile = 'G'; //CUIT

}
