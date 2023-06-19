<?php

namespace App\Models\Cold;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class ColdMachine extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $dateFormat = 'U';

    protected $table = "cold_machine";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'imei',
        'id_status',
        'id_client',
        'id_model',
        'id_user_created',
        'id_user_updated',
        'maxFuel',
        'sim',
        'deleted',
        'created_at',
        'updated_at'
    ];

//    protected $dates = [
//        'created_at',
//        'updated_at'
//    ];

    protected $casts = [
        'id_status'      => 'integer',
        'deleted'      => 'integer',
        'maxFuel'      => 'integer'
//        'created_at' => 'datetime:Y-m-d H:i:s',
//        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function machineModel(){
        return $this->hasOne('App\Models\Cold\ColdMachineModel','id','id_model');
    }

    public function client(){
        return $this->hasOne('App\Models\Admin\Client','id','id_client');
    }

    public function userCreated(){
        return $this->hasOne('App\Models\User','id','id_user_created');
    }

    public function userUpdated(){
        return $this->hasOne('App\Models\User','id','id_user_updated');
    }

    public function realTime(){
        return $this->hasOne('App\Models\Cold\ColdMachineRealTime','id_cold_machine','id');
    }

}
