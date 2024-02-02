<?php

namespace App\Models\V2;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class TipoPersonal extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "personal_tipo";
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
        'nombre',
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
        'id_estado' =>  'integer',
        'id_eliminado' =>  'boolean',
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

}
