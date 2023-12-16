<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Enums\IdTipoRuta;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "rutas";
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
        'id_tipo',
        'id_categoria',
        'id_sede',
        'id_cliente',
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
        'total' =>  'integer',
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'id_tipo' => IdTipoRuta::class,
        'id_estado' => IdEstado::class,
        'id_eliminado' => IdEliminado::class,
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

    public function tipo(){
        return $this->hasOne('App\Models\V2\TipoRuta','id','id_tipo');
    }

    public function sede(){
        return $this->hasOne('App\Models\V2\Sede','id','id_sede');
    }

//    public function paraderos(){
//        return $this->hasMany('App\Models\V2\Paradero','idRuta','id');
//    }

    public function paraderos(){
        return $this->hasMany('App\Models\V2\BoletoPrecio','id_ruta','id');
    }

}
