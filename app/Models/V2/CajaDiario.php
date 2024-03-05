<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class CajaDiario extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "caja_diario";
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
        'id_caja',
        'id_ruta',
        'id_cliente',
        'monto_inicial',
        'monto_final',
        'id_estado',
        'id_eliminado',
        'id_usu_registro',
        'id_usu_modifico',
        'f_apertura',
        'f_cierre',
        'f_registro',
        'f_modifico',



        'total',
        'saldo'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total' =>  'integer',
        'saldo' =>  'float',
        'monto_inicial' =>  'float',
        'monto_final' =>  'float',
        'f_apertura' =>  'string',
        'f_cierre' =>  'string',
        'f_cegistro' =>  'string',
        'f_modifico' =>  'string',
        'id_estado' => 'integer',
        'id_eliminado' => IdEliminado::class
    ];

    public function estado(){
        return $this->hasOne('App\Models\V2\EstadoCajaDiario','id','id_estado');
    }

    public function caja(){
        return $this->hasOne('App\Models\V2\Caja','id','id_caja');
    }

    public function ruta(){
        return $this->hasOne('App\Models\V2\Ruta','id','id_ruta');
    }

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }
}
