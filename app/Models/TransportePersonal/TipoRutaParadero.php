<?php

namespace App\Models\TransportePersonal;

use Illuminate\Database\Eloquent\Model;

class TipoRutaParadero extends Model
{

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    //protected $dateFormat = 'U';

    protected $table = "tp_tipo_ruta_paradero";

    /**
     * @var string[]
     */
    protected $fillable = [
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

}
