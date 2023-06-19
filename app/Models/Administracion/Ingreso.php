<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
//    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;
//    const DELETED = 'deleted';

    protected $table = "adm_ingreso";


    protected $fillable = [
        'id',
        'date',
        'id_tipo_ingreso',
        'id_vehicle',
        'id_personal',
        'id_route',
        'amount',
        'observation',
        'id_client',
        'id_status',
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

    public function route(){
        return $this->hasOne('App\Models\Administracion\Ruta','id','id_route');
    }

    public function tipoIngreso(){
        return $this->hasOne('App\Models\Administracion\TipoIngreso','id','id_tipo_ingreso');
    }

}
