<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Enums\IdTipoRuta;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Paradero extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "paradero";
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
//        'precioBase',
        'latitud',
        'longitud',
        'id_cliente',
        'id_tipo_ruta',
//        'idRuta',
        'id_estado',
        'id_eliminado',
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
//        'precioBase' =>  'float',
        'latitud' =>  'float',
        'longitud' =>  'float',
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'id_tipo_ruta' => IdTipoRuta::class,
        'id_estado' => IdEstado::class,
        'id_eliminado' => IdEliminado::class,
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }
//
//    public function ruta(){
//        return $this->hasOne('App\Models\V2\Ruta','id','idRuta');
//    }

    public function tipoRuta(){
        return $this->hasOne('App\Models\V2\TipoRuta','id','id_tipo_ruta');
    }

}
