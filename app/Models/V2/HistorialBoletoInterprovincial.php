<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class HistorialBoletoInterprovincial extends Model
{
//    use UUID;

    protected $table = "historial_boleto_interprovincial";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'id_boleto',
        'id_cliente',
        'id_accion',
        'descripcion',
        'id_usu_registro',
        'f_registro'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'f_registro' =>  'string',
        'id_accion' => 'integer',
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function accion(){
        return $this->hasOne('App\Models\V2\Accion','id','id_accion');
    }


}
