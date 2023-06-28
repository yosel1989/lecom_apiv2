<?php

namespace App\Models\Administracion;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\MyCustom\Eloquent\SoftDeletesBoolean;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "vehiculos";
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
        'placa',
        'unidad',
        'idCliente',
        'idCategoria',
        'idModelo',
        'idClass',
        'idMarca',
        'idFlota',
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
}
