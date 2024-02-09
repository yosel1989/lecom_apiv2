<?php

namespace App\Models\V2;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class LiquidacionEstadoMotivo extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "liquidacion_estado_motivo";
    public $timestamps = true;

    const CREATED_AT = 'f_registro';
    const UPDATED_AT = 'f_modifico';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'id_cliente',
        'id_liquidacion',
        'id_liquidacion_motivo',
        'id_usu_registro',
        'id_usu_modifico',
        'f_registro',
        'f_modifico',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id_liquidacion_motivo' =>  'integer',
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

    public function motivo(){
        return $this->hasOne('App\Models\V2\LiquidacionMotivo','id','id_liquidacion_motivo');
    }

}
