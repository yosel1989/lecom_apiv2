<?php

namespace App\Models\TransportePersonal;

use Illuminate\Database\Eloquent\Model;

class AbordajeDestino extends Model
{

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;

    //protected $dateFormat = 'U';

    protected $table = "tp_abordaje_destino";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'matricula',
        'id_ruta',
        'id_vehicle',
        'id_tipo_ruta',
        'id_paradero_abordaje',
        'id_paradero_destino',
        'id_client',
        'hora',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id_status' => 'integer',
        'created_at'      => 'datetime:Y-m-d H:i:s',
        'updated_at'      => 'datetime:Y-m-d H:i:s',
    ];

    public function paraderoAbordaje(){
        return $this->hasOne('App\Models\TransportePersonal\Paradero','id','id_paradero_abordaje');
    }

    public function paraderoDestino(){
        return $this->hasOne('App\Models\TransportePersonal\Paradero','id','id_paradero_destino');
    }

    public function tipoRuta(){
        return $this->hasOne('App\Models\TransportePersonal\TipoRuta','id','id_tipo_ruta');
    }

    public function ruta(){
        return $this->hasOne('App\Models\TransportePersonal\Ruta','id','id_ruta');
    }

    public function vehiculo(){
        return $this->hasOne('App\Models\General\Vehicle','id','id_vehicle');
    }

}
