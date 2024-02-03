<?php

namespace App\Models\V2;

use App\Enums\EnumEstado;
use App\Enums\IdEliminado;
use App\Enums\IdTipoRuta;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class BoletoPrecio extends Model
{
    use UUID;
//    use TableNameDynamic;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "boleto_precio";
    public $timestamps = true;
    protected $dynamicTableName;

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
        'id_tipo_ruta',
        'id_ruta',
        'id_paradero_origen',
        'id_paradero_destino',
        'precio_base',
        'id_estado',
        'id_eliminado',
        'id_usu_registro',
        'id_usu_modifico',
        'f_registro',
        'f_modifico',
        'predeterminado',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id_tipo_ruta' => IdTipoRuta::class,
        'id_estado' => EnumEstado::class,
        'id_eliminado' => IdEliminado::class,
        'predeterminado' => 'boolean',
        'precio_base' => 'float',
        'f_registro' => 'string',
        'f_modifico' => 'string',
        'total' => 'integer',
    ];

    public function paraderoOrigen(){
        return $this->hasOne('App\Models\V2\Paradero','id','id_paradero_origen');
    }

    public function paraderoDestino(){
        return $this->hasOne('App\Models\V2\Paradero','id','id_paradero_destino');
    }

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','id_usu_registro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','id_usu_modifico');
    }

    public function ruta(){
        return $this->hasOne('App\Models\V2\Ruta','id','id_ruta');
    }

    public function tipoRuta(){
        return $this->hasOne('App\Models\V2\TipoRuta','id','id_tipo_ruta');
    }

}
