<?php

namespace App\Models\Admin;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class Gps extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "gps";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'imei',
        'id_gps_model',
        'type',
        'id_client',
        'deleted'
    ];

    protected $casts = [
        'deleted'      => 'integer',
        'type'      => 'integer',
    ];

    public function idModel_pk(){
        return $this->belongsTo('App\Models\Admin\GpsModel','id_gps_model');
    }

    public function idClient_pk(){
        return $this->belongsTo('App\Models\Admin\Client','id_client');
    }
}
