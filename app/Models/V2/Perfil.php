<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Enums\IdNivelUsuario;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "perfil";
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
        'id_nivel_usuario',
        'id_cliente',
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
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'id_estado' => IdEstado::class,
        'id_eliminado' => IdEliminado::class,
        'id_nivel_usuario' => IdNivelUsuario::class,
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

}
