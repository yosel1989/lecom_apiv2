<?php

namespace App\Models\Cold;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class ColdMachineAlert extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $dateFormat = 'U';

    protected $table = "cold_machine_alert";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'code',
        'text',
        'description',
        'id_user_created',
        'id_user_updated',
        'deleted',
        'created_at',
        'updated_at'
    ];

//    protected $dates = [
//        'created_at',
//        'updated_at'
//    ];

    protected $casts = [
        'code'      => 'integer',
        'deleted'      => 'integer'
//        'created_at' => 'datetime:Y-m-d H:i:s',
//        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];


}
