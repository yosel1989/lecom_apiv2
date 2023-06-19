<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class HojaRuta extends Model
{
//    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;
//    const DELETED = 'deleted';

    protected $table = "adm_hoja_ruta";


    protected $fillable = [
        'id',
        'id_vehicle',
        'id_personal',
        'id_route',
        'date_assigned',
        'time_assigned',
        'url_route_sheet',
        'id_client',
        'id_user_created',
        'id_user_updated',
        'id_status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id_status' => 'integer',
        'date_assigned'      => 'date:Y-m-d',
        'time_assigned'      => 'time:H:i:s',
        'created_at'      => 'datetime:Y-m-d H:i:s',
        'updated_at'      => 'datetime:Y-m-d H:i:s',
    ];

    public function vehicle(){
        return $this->hasOne('App\Models\General\Vehicle','id','id_vehicle');
    }

    public function personal(){
        return $this->hasOne('App\Models\Administracion\Personal','id','id_personal');
    }

    public function ruta(){
        return $this->hasOne('App\Models\Administracion\Ruta','id','id_route');
    }

    public function userCreated(){
        return $this->hasOne('App\Models\User','id','id_user_created');
    }

    public function userUpdated(){
        return $this->hasOne('App\Models\User','id','id_user_updated');
    }

//    public function modules(){
//        return $this->belongsToMany('App\Models\System\Module','client_modules','id_client','id_module','id','id');
//    }
//
//    public function clients()
//    {
//        return $this->hasMany('App\Models\Admin\Client','id_parent_client');
//    }
}
