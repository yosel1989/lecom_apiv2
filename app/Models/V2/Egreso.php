<?php

namespace App\Models\V2;

use App\Enums\EnumEstadoEgreso;
use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "egreso";
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
        'id_tipo_documento_entidad',
        'numero_documento_entidad',
        'nombre_entidad',
        'id_vehiculo',
        'id_personal',
        'total',
        'id_estado',
        'id_eliminado',
        'id_caja',
        'id_caja_diario',
        'id_usu_registro',
        'id_usu_modifico',
        'f_registro',
        'f_modifico',
        'id_tipo_comprobante',
        'f_modifico',
        'f_modifico',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total' =>  'float',
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'id_estado' => EnumEstadoEgreso::class,
        'id_eliminado' => IdEliminado::class
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

    public function vehiculo(){
        return $this->hasOne('App\Models\V2\Vehiculo','id','id_vehiculo');
    }

    public function personal(){
        return $this->hasOne('App\Models\V2\Personal','id','id_personal');
    }

    public function caja(){
        return $this->hasOne('App\Models\V2\Caja','id','id_caja');
    }

    public function sede(){
        return $this->hasOne('App\Models\V2\Sede','id','id_sede');
    }

    public function estado(){
        return $this->hasOne('App\Models\V2\EstadoEgreso','id','id_estado');
    }

    public function tipoComprobante(){
        return $this->hasOne('App\Models\V2\TipoComprobante','id','id_tipo_comprobante');
    }

    public function tipoDocumento(){
        return $this->hasOne('App\Models\V2\TipoDocumento','id','id_tipo_documento_entidad');
    }

}
