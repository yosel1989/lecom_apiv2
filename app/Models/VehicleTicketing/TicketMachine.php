<?php

namespace App\Models\VehicleTicketing;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class TicketMachine extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;
    const DELETED = 'deleted';

    protected $table = "btj_ticket_machines";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'imei',
        'deleted',
        'id_client',
        'id_vehicle',
        'id_user_created',
        'id_user_updated',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'deleted'      => 'integer',
        'created_at'      => 'datetime:Y-m-d H:i:s',
        'updated_at'      => 'datetime:Y-m-d H:i:s',
    ];

    public function client(){
        return $this->hasOne('App\Models\Auth\Client','id','id_client');
    }

    public function vehicle(){
        return $this->hasOne('App\Models\General\Vehicle','id','id_vehicle');
    }

    public function userCreated(){
        return $this->hasOne('App\Models\User','id','id_user_created');
    }

    public function userUpdated(){
        return $this->hasOne('App\Models\User','id','id_user_updated');
    }
}
