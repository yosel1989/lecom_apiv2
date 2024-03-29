<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use Illuminate\Database\Eloquent\Model;

class ModuloMenu extends Model
{
//    use UUID;

    protected $table = "modulo_menu";
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
        'texto',
        'icono',
        'id_tipo_menu',
        'padre',
        'link',
        'id_modulo',
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
        'id_modulo' =>  'integer',
        'id_tipo_menu' =>  'integer',
        'padre' =>  'integer',
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'id_estado' => IdEstado::class,
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

    public function modulo(){
        return $this->hasOne('App\Models\V2\Modulo','id','id_modulo');
    }

    public function hijos(){
        return $this->hasMany( 'App\Models\V2\ModuloMenu', 'padre');
    }

}
