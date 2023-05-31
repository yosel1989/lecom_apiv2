<?php

namespace App\Models\Cold;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class ColdMachineModel extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $dateFormat = 'U';

    protected $table = "cold_machine_model";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'shortname',
        'id_type',
        'id_user_created',
        'id_user_updated',
        'code',
        'deleted',
        'created_at',
        'updated_at'
    ];


    protected $casts = [
        'id'     => 'string',
        'id_type'      => 'integer',
        'deleted'      => 'integer',
//        'created_at' => 'datetime:Y-m-d H:i:s',
//        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function userCreated(){
        return $this->hasOne('App\User','id','id_user_created');
    }

    public function userUpdated(){
        return $this->hasOne('App\User','id','id_user_updated');
    }

}
