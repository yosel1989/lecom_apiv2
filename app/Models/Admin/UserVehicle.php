<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class UserVehicle extends Model
{

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    protected $table = "user_vehicles";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'id_user',
        'id_vehicle'
    ];

    protected $casts = [
    ];

}
