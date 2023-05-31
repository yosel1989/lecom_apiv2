<?php

namespace App\Models\General;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "vehicles";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'plate',
        'unit',
        'deleted',
        'id_client',
        'id_category',
        'id_model',
        'id_class',
        'id_brand',
        'id_fleet'
    ];

    protected $casts = [
        'deleted'      => 'integer',
    ];

    // Marca del vehiculo
    public function idBrand_pk(){
        return $this->belongsTo('App\Models\General\VehicleBrand','id_brand');
    }
    // Flota del vehiculo
    public function idFleet_pk(){
        return $this->belongsTo('App\Models\General\VehicleFleet','id_fleet');
    }
    // Modelo del vehiculo
    public function idModel_pk(){
        return $this->belongsTo('App\Models\General\VehicleModel','id_model');
    }
    // Clase del vehiculo
    public function idClass_pk(){
        return $this->belongsTo('App\Models\General\VehicleClass','id_class');
    }
}
