<?php

namespace App\Models\General;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;


/** Marca de Vehiculos **/
class VehicleBrand extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "vehicle_brands";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'deleted',
    ];

    protected $casts = [
        'deleted'      => 'integer',
    ];
}
