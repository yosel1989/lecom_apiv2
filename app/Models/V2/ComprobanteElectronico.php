<?php

namespace App\Models\V2;

use App\Enums\EnumTipoComprobante;
use Illuminate\Database\Eloquent\Model;

class ComprobanteElectronico extends Model
{

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "ce_comprobante_electronico";
    public $timestamps = true;

    const CREATED_AT = 'f_registro';
    const UPDATED_AT = 'f_modifico';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'id_cliente',
        'id_sede',

        'id_tipo_comprobante',
        'serie',
        'numero',
        'id_sunat_transaccion',


        //            $table->uuid('idClienteSunat')->nullable();
        'id_tipo_documento_entidad',
        'numero_documento_entidad',
        'nombre_entidad',
        'direccion_entidad',
        'email',
        'email1',
        'email2',

        'f_emision',
        'f_vencimiento',

        'id_moneda',
        'tipo_cambio',
        'porcentaje_igv',
        'descuento_global',
        'to_descuento',
        'to_anticipo',
        'to_gravada',
        'to_inafecta',
        'to_exonerada',
        'to_igv',
        'to_gratuita',
        'to_otros',
        'to_isc',
        'total',

        'id_percepcion_tipo',
        'percepcion_base_imponible',
        'to_percepcion',
        'to_incluido_percepcion',

        'id_retencion_tipo',
        'retencion_base_imponible',
        'to_retencion',

        'to_imp_bolsa',
        'observaciones',

        'id_tipo_comprobante_modif',
        'serie_comprobante_modif',
        'numero_comprobante_modif',

        'id_tipo_nota_credito',
        'id_tipo_nota_debito',

        'bl_enviar_sunat',
        'bl_enviar_cliente',

        'condiciones_pago',
        'medio_pago',

        'placa_vehiculo',
        'order_compra_servicio',

        'bl_detraccion',
        'id_detraccion',

        'formato_de_pdf',

        'contingencia',
        'bienes_region_selva',
        'serv_region_selva',

        'id_razon',
        'id_producto',


        'id_estado',
        'id_usu_registro',
        'id_usu_modifico',
        'f_registro',
        'f_modifico'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id_tipo_comprobante' =>  EnumTipoComprobante::class,
        'numero' =>  'integer',
        'id_sunat_transaccion' =>  'integer',
        'id_tipo_documento_entidad' => 'integer',

        'f_emision' => 'string',
        'f_vencimiento' => 'string',
        'id_moneda' => 'integer',
        'tipo_cambio' => 'float',
        'porcentaje_igv' => 'float',
        'descuento_global' => 'float',
        'to_descuento' => 'float',
        'to_anticipo' => 'float',
        'to_gravada' => 'float',
        'to_inafecta' => 'float',
        'to_exonerada' => 'float',
        'to_igv' => 'float',
        'to_gratuita' => 'float',
        'to_otros' => 'float',
        'to_isc' => 'float',
        'total' => 'float',
        'id_percepcion_tipo' => 'integer',
        'percepcion_base_imponible' => 'float',
        'to_percepcion' => 'float',
        'to_incluido_percepcion' => 'float',
        'id_retencion_tipo' => 'integer',
        'retencion_base_imponible' => 'float',
        'to_retencion' => 'float',
        'to_imp_bolsa' => 'float',
        'id_tipo_comprobante_modif' => 'integer',
        'numero_comprobante_modif' => 'integer',
        'id_tipo_nota_credito' => 'integer',
        'id_tipo_nota_debito' => 'integer',
        'bl_enviar_sunat' => 'boolean',
        'bl_enviar_cliente' => 'boolean',
        'detraccion' => 'boolean',
        'id_detraccion' => 'integer',
        'contingencia' => 'boolean',
        'bienes_region_selva' => 'boolean',
        'serv_region_selva' => 'boolean',
        'id_razon' => 'integer',


        'id_estado' =>  'integer',
        'f_registro' =>  'string',
        'f_modifico' =>  'string'
    ];

}
