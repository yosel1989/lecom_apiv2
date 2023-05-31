<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
//use App\MyCustom\Eloquent\SoftDeletesBoolean;

class Personal extends Model
{
//    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;
//    const DELETED = 'deleted';

    protected $table = "adm_personal";


    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'personal_document',
        'birth_date',
        'id_personal_category',
        'id_client',
        'id_user_created',
        'id_user_updated',
        'id_status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id_status' => 'integer',
        'birth_date'      => 'date:Y-m-d',
        'created_at'      => 'datetime:Y-m-d H:i:s',
        'updated_at'      => 'datetime:Y-m-d H:i:s',
    ];

    public function category(){
        return $this->hasOne('App\Models\Administracion\PersonalCategoria','id','id_personal_category');
    }

    public function userCreated(){
        return $this->hasOne('App\User','id','id_user_created');
    }

    public function userUpdated(){
        return $this->hasOne('App\User','id','id_user_updated');
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
