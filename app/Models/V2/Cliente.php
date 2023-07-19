<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Enums\IdTipoCliente;
use App\Enums\IdTipoDocumento;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "clientes";
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
        'codigo',
        'idTipoDocumento',
        'numeroDocumento',
        'nombre',
        'nombreContacto',
        'correo',
        'dirección',
        'telefono1',
        'telefono2',
        'idTipo',
        'idEstado',
        'idEliminado',
        'idClientePadre',
        'idUsuarioRegistro',
        'idUsuarioModifico',
        'fechaRegistro',
        'fechaModifico'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'idTipoDocumento' => IdTipoDocumento::class,
        'fechaRegistro' =>  'string',
        'fechaModifico' =>  'string',
        'idTipo' => IdTipoCliente::class,
        'idEstado' => IdEstado::class,
        'idEliminado' => IdEliminado::class
    ];

    public function sede(){
        return $this->hasOne('App\Models\V2\Sede','id','idSede');
    }

    public function tipoDocumento(){
        return $this->hasOne('App\Models\V2\TipoDocumento','id','idTipoDocumento');
    }

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','idUsuarioRegistro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','idUsuarioModifico');
    }

}
