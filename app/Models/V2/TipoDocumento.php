<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    public $incrementing = true;

    protected $table = "tipo_documento";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombre',
        'nombre_corto',
        'num_digitos',
        'apl_factura',
        'apl_boleta',
        'apl_pasajero',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'num_digitos' =>  'integer',
        'apl_factura' =>  'integer',
        'apl_boleta' =>  'integer',
        'apl_pasajero' =>  'integer',
    ];

//    public function usuarioRegistro(){
//        return $this->hasOne('App\Models\User','id','idUsuarioRegistro');
//    }
//
//    public function usuarioModifico(){
//        return $this->hasOne('App\Models\User','id','idUsuarioModifico');
//    }

}
