<?php

namespace App\Models\General;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;


/** Modelo de Vehiculos **/
class VehicleModel extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "vehicle_models";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'deleted',
        'id_vehicle_brand'
    ];

    protected $casts = [
        'deleted'      => 'integer',
    ];

    public function idBrand_pk(){
        return $this->belongsTo('App\Models\General\VehicleBrand','id_vehicle_brand');
    }
}
