<?php

namespace App\Models\V2;

use App\Enums\EnumTipoMedioPago;
use Illuminate\Database\Eloquent\Model;

class MedioPago extends Model
{
    public $incrementing = true;

    protected $table = "medio_pago";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'bl_despacho',
        'bl_entidad_financiera',
        'id_tipo',


        'bl_activado'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'bl_despacho' =>  'bool',
        'bl_entidad_financiera' =>  'bool',
        'bl_activado' =>  'bool',
        'id_tipo' =>  'int',
    ];

    public function tipo(){
        return $this->hasOne( 'App\Models\V2\TipoMedioPago', 'id', 'id_tipo');
    }


}
