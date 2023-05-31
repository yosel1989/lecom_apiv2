<?php

namespace App\Models\Admin;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class SimCard extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "sim_cards";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'number',
        'imei',
        'deleted',
        'status',
        'detail',
        'id_telephone_operator',
        'id_client'
    ];

    protected $casts = [
        'deleted'      => 'integer',
        'status'      => 'integer'
    ];

    public function idOperator_pk(){
        return $this->belongsTo('App\Models\Admin\OperatorPhone','id_telephone_operator');
    }

    public function idClient_pk(){
        return $this->belongsTo('App\Models\Admin\Client','id_client');
    }
}
