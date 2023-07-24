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

    const CREATED_AT = 'fechaRegistro';
    const UPDATED_AT = 'fechaModifico';

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
        'idPersonal',
        'idPerfil',
        'idRol',
        'idCliente',
        'correo',
        'telefono',
        'usuario',
        'clave',
        'idNivel',
        'idEstado',
        'idUsuarioRegistro',
        'idUsuarioModifico',
        'fechaEmailVerifico',
        'idEliminado',
        'fechaRegistro',
        'fechaModifico',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fechaEmailVerifico' => 'string',
        'fechaRegistro' => 'string',
        'fechaModifico' => 'string',
        'clave' => 'hashed',
        'idEstado' => IdEstado::class,
        'idEliminado' => IdEliminado::class,
    ];

    public function modulos(){
        return $this->belongsToMany('App\Models\Admin\Module','user_modules','id_user','id_module','id','id');
    }

    public function client(){
        return $this->hasOne('App\Models\Auth\Client','id','idCliente');
    }

    public function perfil(){
        return $this->hasOne('App\Models\V2\Perfil','id','idPerfil');
    }



    public function cliente(){
        return $this->hasOne('App\Models\V2\Cliente','id','idCliente');
    }

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','idUsuarioRegistro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','idUsuarioModifico');
    }

}
