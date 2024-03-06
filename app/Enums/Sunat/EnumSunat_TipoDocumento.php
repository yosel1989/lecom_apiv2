<?php

namespace App\Enums\Sunat;

enum EnumSunat_TipoDocumento: string
{
    case Factura = '01';
    case Boleta_de_Venta = '03';
    case Liquidacion_de_Compra = '04';
    case Boletos_de_Transporte_Aereo = '05';
    case Carta_Porte_Aereo = '06';
    case Nota_de_Credito = '07';
    case Nota_de_Debito = '08';
    case Guia_de_Remision_Remitente = '09';
    case Poliza_Emitida_Bolsas_de_Valores = '11';
    case Ticket_Maquina_Registradora = '12';
    case Documento_Bancario_Financiero_Credito_Seguro = '13';
    case Recibo_Servicios_Publicos = '14';
    case Boletos_Transporte_Terrestre_Urbano_o_Ferroviario = '15';
    case Boleto_Viaje_Transporte_Publico_Interprovincial = '16';

}
