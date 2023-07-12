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

    const CREATED_AT = 'fechaRegistro';
    const UPDATED_AT = 'fechaModifico';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombre',
        'idNivelUsuario',
        'idCliente',
        'idEstado',
        'idEliminado',
        'idUsuarioRegistro',
        'idUsuarioModifico',
        'fechaRegistro',
        'fechaModifico',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fechaRegistro' =>  'string',
        'fechaModifico' =>  'string',
        'idEstado' => IdEstado::class,
        'idEliminado' => IdEliminado::class,
        'idNivelUsuario' => IdNivelUsuario::class,
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','idUsuarioRegistro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','idUsuarioModifico');
    }

}
