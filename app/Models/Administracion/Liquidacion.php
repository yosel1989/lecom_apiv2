<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
//    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;
//    const DELETED = 'deleted';

    protected $table = "adm_liquidacion";


    protected $fillable = [
        'id',
        'id_tipo_liquidacion',
        'date',
        'date_start',
        'date_end',
        'id_vehicle',
        'id_personal',
        'amount',
        'observation',
        'id_status',
        'id_client',
        'id_user_created',
        'id_user_updated',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id_status' => 'integer',
        'amount' => 'float',
        'created_at'      => 'datetime:Y-m-d H:i:s',
        'updated_at'      => 'datetime:Y-m-d H:i:s',
        'date'      => 'datetime:Y-m-d',
        'date_start'      => 'datetime:Y-m-d',
        'date_end'      => 'datetime:Y-m-d',
    ];


    public function userCreated(){
        return $this->hasOne('App\Models\User','id','id_user_created');
    }

    public function userUpdated(){
        return $this->hasOne('App\Models\User','id','id_user_updated');
    }

    public function vehicle(){
        return $this->hasOne('App\Models\General\Vehicle','id','id_vehicle');
    }

    public function personal(){
        return $this->hasOne('App\Models\Administracion\Personal','id','id_personal');
    }

}
