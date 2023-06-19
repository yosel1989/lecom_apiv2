<?php

namespace App\Models\TransportePersonal;

use Illuminate\Database\Eloquent\Model;

class Troncal extends Model
{

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    //protected $dateFormat = 'U';

    protected $table = "tp_troncal";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'id_status',
        'id_user_created',
        'id_user_updated',
        'id_client',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id_status' => 'integer',
        'created_at'      => 'datetime:Y-m-d H:i:s',
        'updated_at'      => 'datetime:Y-m-d H:i:s',
    ];

    public function client(){
        return $this->hasOne('App\Models\Auth\Client','id','id_client');
    }

    public function userCreated(){
        return $this->hasOne('App\Models\User','id','id_user_created');
    }

    public function userUpdated(){
        return $this->hasOne('App\Models\User','id','id_user_updated');
    }

}
