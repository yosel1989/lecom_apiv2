<?php

namespace App\Models\Cold;


use Illuminate\Database\Eloquent\Model;

class ColdMachineHistory extends Model
{

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    //const DELETED = 'deleted';

    protected $dateFormat = 'U';

    protected $table = "cold_machine_history";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'type',
        'imei',
        'status',
        'level_fuel',
        'level_battery',
        'level_output',
        'frequency_output',
        'temperature_motor',
        'hourmeter',
        'temperature_supply',
        'temperature_return',
        'humidity',
        'co2',
        'sp_temperature',
        'sp_co2',
        'sp_humidity',
        'id_client',
        'id_cold_machine',
        'latitude',
        'longitude',
        'created_at'
    ];


    protected $casts = [
        'type'      => 'integer',
        'status'      => 'integer',
        'level_fuel'      => 'float',
        'level_battery'      => 'float',
        'level_output'      => 'float',
        'frequency_output'      => 'float',
        'temperature_motor'      => 'float',
        'hourmeter'      => 'integer',
        'temperature_supply'      => 'float',
        'temperature_return'      => 'float',
        'humidity'      => 'float',
        'co2'      => 'integer',
        'sp_temperature'      => 'float',
        'sp_co2'      => 'float',
        'sp_humidity'      => 'float',
        'latitude' => 'float',
        'longitude' => 'float',
//        'created_at' => 'datetime:Y-m-d H:i:s',
//        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}
