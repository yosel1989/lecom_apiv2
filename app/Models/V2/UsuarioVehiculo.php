<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class UsuarioVehiculo extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "usuario_vehiculos";
    public $timestamps = true;

    const CREATED_AT = 'fechaRegistro';
    const UPDATED_AT = 'fechaModifico';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idUsuario',
        'idVehiculo',
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
    ];


    // Marca del vehiculo
    public function idBrand_pk(){
        return $this->belongsTo('App\Models\General\VehicleBrand','idMarca');
    }
    // Flota del vehiculo
    public function idFleet_pk(){
        return $this->belongsTo('App\Models\General\VehicleFleet','idFlota');
    }
    // Modelo del vehiculo
    public function idModel_pk(){
        return $this->belongsTo('App\Models\General\VehicleModel','idModelo');
    }
    // Clase del vehiculo
    public function idClass_pk(){
        return $this->belongsTo('App\Models\General\VehicleClass','idClase');
    }

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','idUsuarioRegistro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','idUsuarioModifico');
    }
}
