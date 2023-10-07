<?php

namespace App\Models\V2;

use App\Enums\EnumParametroConfiguracion;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class ClienteConfiguracion extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "cliente_configuracion";
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
        'id_parametro_configuracion',
        'id_cliente',
        'valor',
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
        'id_parametro_configuracion' => EnumParametroConfiguracion::class
    ];

    public function parametro(){
        return $this->hasOne('App\Models\V2\ParametroConfiguracion','id','id_parametro_configuracion');
    }

}
