<?php

namespace App\Models\General;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;


/** Clase de Vehiculos **/
class VehicleClass extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "vehicle_classes";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'icon',
        'deleted',
    ];

    protected $casts = [
        'deleted'      => 'integer',
    ];
}
