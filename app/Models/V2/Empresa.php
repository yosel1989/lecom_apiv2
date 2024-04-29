<?php

namespace App\Models\V2;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "ce_empresa";
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
        'nombre',
        'ruc',
        'direccion',
        'id_ubigeo',
        'id_cliente',
        'id_estado',
        'id_eliminado',
        'predeterminado',
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
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'id_estado' => 'integer',
        'id_eliminado' => 'integer',
        'predeterminado' => 'boolean'
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

    public function ubigeo(){
        return $this->hasOne('App\Models\V2\Ubigeo','id','id_ubigeo');
    }

}
