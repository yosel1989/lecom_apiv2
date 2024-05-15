<?php

namespace App\Models\V2;

use App\Enums\EnumEstadoCajaTraslado;
use App\Enums\IdEliminado;
use Illuminate\Database\Eloquent\Model;

class CajaTraslado extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "caja_traslado";
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
        'id_tipo_comprobante',
        'serie',
        'numero',
        'id_personal',
        'id_sede',
        'id_caja_origen',
        'id_caja_diario_origen',
        'id_caja_destino',
        'id_caja_diario_destino',
        'monto',
        'id_estado',
        'id_eliminado',
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
        'monto' =>  'float',
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'id_estado' => EnumEstadoCajaTraslado::class,
        'id_eliminado' => IdEliminado::class
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

    public function cajaOrigen(){
        return $this->hasOne('App\Models\V2\Caja','id','id_caja_origen');
    }

    public function cajaDestino(){
        return $this->hasOne('App\Models\V2\Caja','id','id_caja_destino');
    }

    public function sede(){
        return $this->hasOne('App\Models\V2\Sede','id','id_sede');
    }

    public function estado(){
        return $this->hasOne('App\Models\V2\EstadoCajaTraslado','id','id_estado');
    }

    public function tipoComprobante(){
        return $this->hasOne('App\Models\V2\TipoComprobante','id','id_tipo_comprobante');
    }

    public function personal(){
        return $this->hasOne('App\Models\V2\Personal','id','id_personal');
    }

    public function medioPago(){
        return $this->hasOne('App\Models\V2\MedioPago','id','id_medio_pago');
    }

}
