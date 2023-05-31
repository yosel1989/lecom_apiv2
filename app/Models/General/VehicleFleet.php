<?php

namespace App\Models\General;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;


// Flota de Vehiculos
class VehicleFleet extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "vehicle_fleets";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'deleted',
        'id_client'
    ];

    protected $casts = [
        'deleted'      => 'integer',
    ];
}
