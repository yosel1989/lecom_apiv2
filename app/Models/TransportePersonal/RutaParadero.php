<?php

namespace App\Models\TransportePersonal;

use Illuminate\Database\Eloquent\Model;

class RutaParadero extends Model
{

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    //protected $dateFormat = 'U';

    protected $table = "tp_ruta_paradero";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id_ruta',
        'id_tipo_ruta',
        'id_paradero',
        'id_tipo_paradero',
    ];

    protected $casts = [
        'id_tipo_paradero' => 'integer',
    ];

    public function paradero(){
        return $this->hasOne('App\Models\TransportePersonal\Paradero','id','id_paradero');
    }

    public function tipoRuta(){
        return $this->hasOne('App\Models\TransportePersonal\TipoRuta','id','id_tipo_ruta');
    }

}
