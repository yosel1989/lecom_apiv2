<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "cronograma";
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
        'id_tipo_ruta',
        'id_ruta',
        'fecha',


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
        'fecha' =>  'string',
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'id_estado' => 'integer',
        'id_eliminado' => IdEliminado::class
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

    public function sede(){
        return $this->hasOne('App\Models\V2\Sede','id','id_sede');
    }

    public function tipoRuta(){
        return $this->hasOne('App\Models\V2\TipoRuta','id','id_tipo_ruta');
    }

    public function ruta(){
        return $this->hasOne('App\Models\V2\Ruta','id','id_ruta');
    }


}
