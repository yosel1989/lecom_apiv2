<?php

namespace App\Models\Admin;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class Ert extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "ert";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'id_client',
        'id_vehicle',
        'id_type',
        'id_gps',
        'id_sim',
        'sutran',
        'period',
        'deleted'
    ];

    protected $casts = [
        'deleted'     => 'integer',
        'period'     => 'integer',
        'sutran'      => 'integer'
    ];

    public function idClient_pk(){
        return $this->belongsTo('App\Models\Admin\Client','id_client');
    }

    public function idVehicle_pk(){
        return $this->belongsTo('App\Models\General\Vehicle','id_vehicle');
    }

    public function idSimCard_pk(){
        return $this->belongsTo('App\Models\Admin\SimCard','id_sim');
    }

    public function idGps_pk(){
        return $this->belongsTo('App\Models\Admin\Gps','id_gps');
    }
}
