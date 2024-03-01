<?php

namespace App\Models\V2;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "ingreso";
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
        'id_tipo_ingreso',
        'detalle',
        'id_tipo_documento_entidad',
        'numero_documento_entidad',
        'nombre_entidad',
        'importe',
        'id_caja',
        'id_caja_diario',
        'bl_contabilizado',
        'bl_aprobado',
        'bl_revisado',
        'id_medio_pago',
        'numero_operacion',
        'id_entidad_financiera',

        'id_estado',
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
        'bl_contabilizado' =>  'boolean',
        'bl_aprobado' =>  'boolean',
        'bl_revisado' =>  'boolean',
        'importe' =>  'float',
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'numero' => 'integer',
        'id_entidad_financiera' => 'integer',
        'id_estado' => 'integer',
        'id_medio_pago' => 'integer',
        'id_tipo_comprobante' => 'integer',
    ];

    public function tipoComprobante(){
        return $this->hasOne('App\Models\V2\TipoComprobante','id','id_tipo_comprobante');
    }

    public function tipoDocumento(){
        return $this->hasOne('App\Models\V2\TipoDocumento','id','id_tipo_documento_entidad');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function estado(){
        return $this->hasOne('App\Models\V2\EstadoIngreso','id','id_estado');
    }

    public function entidadFinanciera(){
        return $this->hasOne('App\Models\V2\EntidadFinanciera','id','id_entidad_financiera');
    }

    public function medioPago(){
        return $this->hasOne('App\Models\V2\MedioPago','id','id_medio_pago');
    }

    public function caja(){
        return $this->hasOne('App\Models\V2\Caja','id','id_caja');
    }

    public function sede(){
        return $this->hasOne('App\Models\V2\Sede','id','id_sede');
    }

    public function tipoIngreso(){
        return $this->hasOne('App\Models\V2\IngresoTipo','id','id_tipo_ingreso');
    }

}
