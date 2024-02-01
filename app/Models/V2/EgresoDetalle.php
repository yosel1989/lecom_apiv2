<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use Illuminate\Database\Eloquent\Model;

class EgresoDetalle extends Model
{

    public $incrementing = false;

    protected $table = "egreso_detalle";
    public $timestamps = true;

    const CREATED_AT = 'f_registro';
    const UPDATED_AT = 'f_modifico';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_egreso',
        'id_cliente',
        'id_egreso_tipo',
        'fecha',
        'importe',
        'id_estado',
        'id_eliminado',
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
        'importe' =>  'float',
        'fecha' =>  'string',
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'id_estado' => IdEstado::class,
        'id_eliminado' => IdEliminado::class
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

    public function egresoTipo(){
        return $this->hasOne('App\Models\V2\EgresoTipo','id','id_egreso_tipo');
    }


}
