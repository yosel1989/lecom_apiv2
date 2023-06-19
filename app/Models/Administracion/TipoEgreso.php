<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class TipoEgreso extends Model
{
//    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;
//    const DELETED = 'deleted';

    protected $table = "adm_tipo_egreso";

    protected $fillable = [
        'id',
        'name',
        'description',
        'has_vehicle',
        'has_personal',
        'has_route',
        'id_client',
        'id_status',
        'id_user_created',
        'id_user_updated',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id_status' => 'integer',
        'has_vehicle' => 'integer',
        'has_personal' => 'integer',
        'has_route' => 'integer',
        'created_at'      => 'datetime:Y-m-d H:i:s',
        'updated_at'      => 'datetime:Y-m-d H:i:s',
    ];


    public function userCreated(){
        return $this->hasOne('App\Models\User','id','id_user_created');
    }

    public function userUpdated(){
        return $this->hasOne('App\Models\User','id','id_user_updated');
    }

}
