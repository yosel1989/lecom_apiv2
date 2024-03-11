<?php

namespace Sunat\Enums;

enum TipoDocumentoEntidad: string
{
    case Doc_Trib_No_Dom_Sin_Ruc = '0';
    case Doc_Nacional_de_Identidad = '1'; //DNI
    case Carnet_de_Extranjeria = '4'; //CEX
    case Registro_Unico_de_Contribuyente = '6'; //RUC
    case Pasaporte = '7'; //PAS;
    case Cedular_Diplomatica_Identidad = 'A'; //CED
    case Doc_Identidad_Pais_Residencia_No_D = 'B';
    case Tax_Ident_Number_TIN_Doc_Trib_PPNN = 'C';
    case Ident_Numb_IN_Doc_Trib_PPJJ = 'D';
    case Tarjeta_Andrina_Migracion = 'E'; //TAM

}
