<?php

namespace App\Models\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class EgresoTipo extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "egreso_tipo";
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
        'id_cliente',
        'id_categoria_egreso',
        'precio_base',
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
        'f_registro' =>  'string',
        'f_modifico' =>  'string',
        'precio_base' =>  'float',
        'id_estado' => IdEstado::class,
        'id_eliminado' => IdEliminado::class
    ];

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

    public function categoria(){
        return $this->hasOne('App\Models\V2\EgresoCategoria','id','id_categoria_egreso');
    }

}
