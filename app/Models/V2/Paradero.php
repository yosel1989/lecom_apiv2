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

    protected $table = "paraderos";
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
        'precioBase',
        'latitud',
        'longitud',
        'idCliente',
        'idTipoRuta',
        'idRuta',
        'idEstado',
        'idEliminado',
        'idUsuarioRegistro',
        'idUsuarioModifico',
        'fechaRegistro',
        'fechaModifico',

        'total'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total' =>  'int',
        'precioBase' =>  'float',
        'latitud' =>  'float',
        'longitud' =>  'float',
        'fechaRegistro' =>  'string',
        'fechaModifico' =>  'string',
        'idTipoRuta' => IdTipoRuta::class,
        'idEstado' => IdEstado::class,
        'idEliminado' => IdEliminado::class,
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','idUsuarioRegistro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','idUsuarioModifico');
    }

    public function ruta(){
        return $this->hasOne('App\Models\V2\Ruta','id','idRuta');
    }

    public function tipoRuta(){
        return $this->hasOne('App\Models\V2\TipoRuta','id','idTipoRuta');
    }

}
