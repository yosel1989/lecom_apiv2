<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "destinos";

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
        'idCliente',
        'idEstado',
        'idEliminado',
        'fechaRegistro',
        'fechaModifico',
        'idUsuarioRegistro',
        'idUsuarioModifico',

        'precio'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'precioBase' => 'float',
        'precio' => 'float',
        'fechaRegistro' => 'string',
        'fechaModifico' => 'string',
        'idEstado' => IdEstado::class,
        'idEliminado' => IdEliminado::class,
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','idUsuarioRegistro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','idUsuarioModifico');
    }

}
