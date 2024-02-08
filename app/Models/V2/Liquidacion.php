<?php

namespace App\Models\V2;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "liquidacion";
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
        'codigo',
        'id_cliente',
        'id_vehiculos',
        'id_personal',
        'f_inicio',
        'f_fin',
        'archivo',
        'id_estado',
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
        'id_vehiculos' => 'array',
        'codigo' =>  'integer',
        'f_inicio' =>  'string',
        'f_fin' =>  'string',
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'id_estado' => 'integer'
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

    public function estado(){
        return $this->hasOne('App\Models\V2\EstadoLiquidacion','id','id_estado');
    }

}
