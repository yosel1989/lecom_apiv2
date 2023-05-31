<?php

namespace App\Models\TransportePersonal;

use Illuminate\Database\Eloquent\Model;

class RutaVehiculo extends Model
{

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    //protected $dateFormat = 'U';

    protected $table = "tp_ruta_vehiculo";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id_ruta',
        'id_vehiculo'
    ];

    public function ruta(){
        return $this->hasOne('App\Models\TransportePersonal\Ruta','id','id_ruta');
    }

    public function vehiculo(){
        return $this->hasOne('App\Models\General\Vehicle','id','id_vehiculo');
    }


}
