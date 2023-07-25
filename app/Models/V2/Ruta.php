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
        'idTipo',
        'idCategoria',
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
        'idTipo' => IdTipoRuta::class,
        'idEstado' => IdEstado::class,
        'idEliminado' => IdEliminado::class,
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','idUsuarioRegistro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','idUsuarioModifico');
    }

    public function tipo(){
        return $this->hasOne('App\Models\V2\TipoRuta','id','idTipo');
    }

    public function paraderos(){
        return $this->hasMany('App\Models\V2\Paradero','idRuta','id');
    }

}
