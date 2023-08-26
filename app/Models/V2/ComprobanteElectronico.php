<?php

namespace App\Models\V2;

use App\Enums\EnumRazonComprobante;
use App\Enums\EnumTipoMoneda;
use App\Enums\EnumTipoPago;
use App\Enums\IdTipoDocumento;
use Illuminate\Database\Eloquent\Model;

class ComprobanteElectronico extends Model
{

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "comprobante_electronico";
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
        'idCliente',
        'idTipoDocumento',
        'numeroDocumento',
        'nombre',
        'direccion',
        'idRazon',
        'serie',
        'numero',
        'idTipoMoneda',
        'idTipoPago',
        'subTotal',
        'igv',
        'total',
        'observaciones',
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
        'idTipoDocumento' =>  IdTipoDocumento::class,
        'idRazon' =>  EnumRazonComprobante::class,
        'idTipoMoneda' =>  EnumTipoMoneda::class,
        'idTipoPago' =>  EnumTipoPago::class,
        'numero' =>  'integer',
        'subTotal' =>  'float',
        'igv' =>  'integer',
        'total' =>  'integer',
        'idEstado' =>  'integer',
        'idEliminado' =>  'integer'
    ];

}
