<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "vehiculos";
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
        'codigo',
        'placa',
        'unidad',
        'id_cliente',
        'id_categoria',
        'id_modelo',
        'id_clase',
        'id_marca',
        'id_flota',
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
        'id' =>  'string',
        'codigo' =>  'integer',
        'total' =>  'integer',
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'id_estado' => IdEstado::class,
        'id_eliminado' => IdEliminado::class,
    ];


    // Marca del vehiculo
    public function idBrand_pk(){
        return $this->belongsTo('App\Models\General\VehicleBrand','id_marca');
    }
    // Flota del vehiculo
    public function idFleet_pk(){
        return $this->belongsTo('App\Models\General\VehicleFleet','id_flota');
    }
    // Modelo del vehiculo
    public function idModel_pk(){
        return $this->belongsTo('App\Models\General\VehicleModel','id_modelo');
    }
    // Clase del vehiculo
    public function idClass_pk(){
        return $this->belongsTo('App\Models\General\VehicleClass','id_clase');
    }

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }
}
