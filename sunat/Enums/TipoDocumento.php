<?php

namespace Sunat\Enums;

enum TipoDocumento: string
{
    case Factura = '01';
    case Boleta_de_Venta = '03';
//    case Liquidacion_de_Compra = '04';
//    case Boletos_de_Transporte_Aereo = '05';
//    case Carta_Porte_Aereo = '06';
    case Nota_de_Credito = '07';
    case Nota_de_Debito = '08';
    case Guia_de_Remision_Remitente = '09';
//    case Poliza_Emitida_Bolsas_de_Valores = '11';
    case Ticket_Maquina_Registradora = '12';
    case Documento_Bancario_Financiero_Credito_Seguro = '13';
    case Recibo_Servicios_Publicos = '14';
    case Boletos_Transporte_Terrestre_Urbano_o_Ferroviario = '15';
    case Boleto_Viaje_Transporte_Publico_Interprovincial = '16';
    case Comprobante_de_Retencion = '20';
    case Guia_de_Remision_Transportista = '31';
    case Comprobante_de_Percepcion = '40';
    case Comprobante_de_Percepcion_Venta_Interna_Fisico_Impreso = '41';
    case Comprobante_de_Pagto_SEAE = '56';
    case Guia_de_Remision_Remitente_Complementaria = '71';
    case Guia_de_Remision_Transportista_Complementaria = '72';

}
