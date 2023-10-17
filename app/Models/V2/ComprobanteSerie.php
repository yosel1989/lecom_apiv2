<?php

namespace App\Models\V2;

use App\Enums\EnumTipoComprobante;
use App\Enums\IdEstado;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class ComprobanteSerie extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "ce_serie";
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
        'nombre',
        'id_cliente',
        'id_sede',
        'id_tipo_comprobante',
        'id_estado',
        'id_usu_registro',
        'id_usu_modifico',
        'f_registro',
        'f_modifico',


        'total'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total' =>  'int',
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'id_tipo_comprobante' =>  EnumTipoComprobante::class,
        'id_estado' =>  IdEstado::class,
    ];

    public function sede(){
        return $this->hasOne('App\Models\V2\Sede','id','id_sede');
    }

    public function tipoComprobante(){
        return $this->hasOne('App\Models\V2\TipoComprobante','id','id_tipo_comprobante');
    }

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

}
