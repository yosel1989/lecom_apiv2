<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
//use App\MyCustom\Eloquent\SoftDeletesBoolean;

class PersonalCategoria extends Model
{
//    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;
//    const DELETED = 'deleted';

    protected $table = "adm_personal_categoria";


    protected $fillable = [
        'id',
        'name',
        'code',
        'id_status',
        'id_user_created',
        'id_user_updated',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id_status' => 'integer',
        'created_at'      => 'datetime:Y-m-d H:i:s',
        'updated_at'      => 'datetime:Y-m-d H:i:s',
    ];

    public function userCreated(){
        return $this->hasOne('App\Models\User','id','id_user_created');
    }

    public function userUpdated(){
        return $this->hasOne('App\Models\User','id','id_user_updated');
    }

//
//    public function clients()
//    {
//        return $this->hasMany('App\Models\Admin\Client','id_parent_client');
//    }
}
