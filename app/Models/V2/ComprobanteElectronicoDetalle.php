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
        'idProducto',
        'producto',
        'detalle',
        'cantidad',
        'valor',
        'subTotal',
        'igv',
        'total',
        'idEstado',
        'idEliminado',
        'idUsuarioRegistro',
        'idUsuarioModifico',
        'fechaRegistro',
        'fechaModifico'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fechaRegistro' =>  'string',
        'fechaModifico' =>  'string',
        'idUnidadMedida' =>  EnumUnidadMedida::class,
        'idProducto' =>  EnumRazonComprobante::class,
        'cantidad' =>  'integer',
        'valor' =>  'float',
        'subTotal' =>  'float',
        'igv' =>  'integer',
        'total' =>  'integer',
        'idEstado' =>  'integer',
        'idEliminado' =>  'integer'
    ];

}
