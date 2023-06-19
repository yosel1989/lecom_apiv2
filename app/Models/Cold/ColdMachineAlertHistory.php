<?php

namespace App\Models\Cold;


use Illuminate\Database\Eloquent\Model;

class ColdMachineAlertHistory extends Model
{

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    //const DELETED = 'deleted';

    protected $dateFormat = 'U';

    protected $table = "cold_machine_alert_history";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'id_cold_machine_alert',
        'id_cold_machine',
        'attended',
        'id_user_updated',
        'latitude',
        'id_client',
        'longitude',
        'created_at',
        'updated_at'
    ];

//    protected $dates = [
//        'created_at',
//        'updated_at'
//    ];

    protected $casts = [
        'attended'      => 'integer',
        'latitude' => 'float',
        'longitude' => 'float',
//        'created_at' => 'datetime:Y-m-d H:i:s',
//        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function machine(){
        return $this->hasOne('App\Models\Cold\ColdMachine','id','id_cold_machine');
    }

    public function alert(){
        return $this->hasOne('App\Models\Cold\ColdMachineAlert','id','id_cold_machine_alert');
    }

    public function userUpdated(){
        return $this->hasOne('App\Models\User','id','id_user_updated');
    }

}
