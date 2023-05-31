<?php

namespace App\Models\General;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "vehicle_categories";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'deleted',
        'id_client',
    ];

    protected $casts = [
        'deleted'      => 'integer',
    ];
}
