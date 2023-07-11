<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
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
        'idEstado' => IdEstado::class,
        'idEliminado' => IdEliminado::class
    ];

    public function sede(){
        return $this->hasOne('App\Models\V2\Sede','id','idSede');
    }

}
