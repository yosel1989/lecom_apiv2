<?php

namespace App\Models\V2;

use App\Enums\EnumRazonComprobante;
use App\Enums\EnumUnidadMedida;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class ComprobanteElectronicoDetalle extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "ce_comprobante_electronico_detalle";
    public $timestamps = true;

    const CREATED_AT = 'fechaRegistro';
    const UPDATED_AT = 'fechaModifico';
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
        'imp_bolsa',
        'total',
        'anticipo_regulariza',
        'anticipo_comprobante_serie',
        'anticipo_comprobante_numero',
        'codigo_producto_sunat',
        'tipo_isc',
        'isc',
        'id_usu_registro',
        'id_usu_modifico',
        'f_registro',
        'f_modifico',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'cantidad' =>  'integer',
        'valor' =>  'float',
        'sub_total' =>  'float',
        'igv' =>  'integer',
        'total' =>  'integer',
    ];

}
