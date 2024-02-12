<?php

namespace App\Models\V2;

use App\Enums\EnumUnidadMedida;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class ComprobanteElectronicoItem extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "ce_comprobante_electronico_items";
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
        'id_comprobante',
        'id_cliente',

        'id_unidad_medida',
        'codigo',
        'descripcion',
        'cantidad',
        'valor_unitario',
        'precio_unitario',
        'descuento',
        'sub_total',
        'id_tipo_igv',
        'id_tipo_ivap',
        'igv',
        'impBolsa',
        'total',

        'anticipo_regularizar',
        'anticipo_comprobante_serie',
        'anticipo_comprobante_numero',

        'codigo_producto_sunat',
        'tipo_isc',
        'isc',


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
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'id_unidad_medida' =>  EnumUnidadMedida::class,
        'cantidad' =>  'integer',
        'valor' =>  'float',
        'valor_unitario' =>  'float',
        'precio_unitario' =>  'float',
        'anticipo_regulariza' =>  'boolean',
        'descuento' =>  'float',
        'sub_total' =>  'float',
        'tipo_isc' =>  'float',
        'isc' =>  'float',
        'igv' =>  'float',
        'total' =>  'float'
    ];

}
