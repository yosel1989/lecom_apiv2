<?php

namespace App\Models\TransportePersonal;

use Illuminate\Database\Eloquent\Model;

class ParaderoHora extends Model
{

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    //protected $dateFormat = 'U';

    protected $table = "tp_paradero_hora";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id_paradero',
        'id_ruta',
        'id_tipo_ruta',
        'id_tipo_paradero',
        'hora',
    ];

    protected $casts = [
        'id_tipo_paradero' => 'integer',
    ];

    public function tipoRuta(){
        return $this->hasOne('App\Models\TransportePersonal\TipoRuta','id','id_tipo_ruta');
    }

    public function ruta(){
        return $this->hasOne('App\Models\TransportePersonal\Ruta','id','id_ruta');
    }

}
