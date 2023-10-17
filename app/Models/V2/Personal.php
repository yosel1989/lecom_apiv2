<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Enums\IdTipoDocumento;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "personal";
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
        'foto',
        'nombre',
        'apellido',
        'correo',
        'id_cliente',
        'id_sede',
        'id_tipo_documento',
        'numero_documento',
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
        'id_tipo_documento' => IdTipoDocumento::class,
        'id_estado' => IdEstado::class,
        'id_eliminado' => IdEliminado::class,
    ];

    public function sede(){
        return $this->hasOne('App\Models\V2\Sede','id','id_sede');
    }

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

    public function tipoDocumento(){
        return $this->hasOne('App\Models\V2\TipoDocumento','id','id_tipo_documento');
    }

}
