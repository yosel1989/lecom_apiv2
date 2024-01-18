<?php

namespace App\Models;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\UUID;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "users";

    const CREATED_AT = 'f_registro';
    const UPDATED_AT = 'f_modifico';

    const USER_EMAIL_FIELD  = "correo";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombres',
        'apellidos',
        'id_personal',
        'id_perfil',
        'id_sede',
        'id_rol',
        'id_cliente',
        'correo',
        'telefono',
        'usuario',
        'clave',
        'id_nivel',
        'id_estado',
        'id_usu_registro',
        'id_usu_modifico',
        'fechaEmailVerifico',
        'id_eliminado',
        'f_registro',
        'f_modifico',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'clave',
//        'remember_token',
    ];

    public function getId(): string{
        return $this->id;
    }

    public function getIdCliente(): string{
        return $this->id_cliente;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fechaEmailVerifico' => 'string',
        'f_registro' => 'string',
        'f_modifico' => 'string',
        'clave' => 'hashed',
        'id_estado' => IdEstado::class,
        'id_eliminado' => IdEliminado::class,
    ];

    public function modulos(){
        return $this->belongsToMany('App\Models\Admin\Module','user_modules','id_user','id_module','id','id');
    }

    public function client(){
        return $this->hasOne('App\Models\Auth\Client','id','id_cliente');
    }

    public function perfil(){
        return $this->hasOne('App\Models\V2\Perfil','id','id_perfil');
    }

    public function sede(){
        return $this->hasOne('App\Models\V2\Sede','id','id_sede');
    }

    public function personal(){
        return $this->hasOne('App\Models\V2\Personal','id','id_personal');
    }

    public function cliente(){
        return $this->hasOne('App\Models\V2\Cliente','id','id_cliente');
    }

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

}
