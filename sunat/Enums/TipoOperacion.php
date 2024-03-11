<?php

namespace Sunat\Enums;

enum TipoOperacion: string
{
    case Venta_Interna = '01';
    case Exportacion = '02';
    case No_Domiciliados = '03';
    case Venta_Interna_Anticipos = '04';
    case Venta_Itinerante = '05';
    case Factura_Guia = '06';
    case Venta_Arroz_Pilado = '07';
    case Factura_Comprobante_de_Percepcion = '08';
    case Factura_Guia_remitente = '10';
    case Factura_Guia_Transportista = '11';
    case Boleta_de_Venta_Comprobante_de_Percepcion = '12';
    case Gasto_Deducible_Persona_Natural = '13';
}
