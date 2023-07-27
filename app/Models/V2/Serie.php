<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "series";
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
        'idCliente',
        'idSede',
        'idTipoSerie',
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
        'idTipoSerie' => 'integer',
        'idEstado' => IdEstado::class,
        'idEliminado' => IdEliminado::class
    ];

    public function sede(){
        return $this->hasOne('App\Models\V2\Sede','id','idSede');
    }

    public function tipo(){
        return $this->hasOne('App\Models\V2\TipoSerie','id','idTipoSerie');
    }

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','idUsuarioRegistro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','idUsuarioModifico');
    }
}
