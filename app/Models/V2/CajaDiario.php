<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class CajaDiario extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "caja_diario";
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
        'idCaja',
        'idRuta',
        'idCliente',
        'montoInicial',
        'montoFinal',
        'idEstado',
        'idEliminado',
        'idUsuarioRegistro',
        'idUsuarioModifico',
        'fechaApertura',
        'fechaCierre',
        'fechaRegistro',
        'fechaModifico',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'montoInicial' =>  'float',
        'montoFinal' =>  'float',
        'fechaApertura' =>  'string',
        'fechaApertura' =>  'string',
        'fechaCierre' =>  'string',
        'fechaRegistro' =>  'string',
        'fechaModifico' =>  'string',
        'idEstado' => IdEstado::class,
        'idEliminado' => IdEliminado::class
    ];

    public function caja(){
        return $this->hasOne('App\Models\V2\Caja','id','idCaja');
    }

    public function ruta(){
        return $this->hasOne('App\Models\V2\Ruta','id','idRuta');
    }

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','idUsuarioRegistro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','idUsuarioModifico');
    }
}
