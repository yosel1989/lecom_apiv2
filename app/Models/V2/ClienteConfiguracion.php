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

    const CREATED_AT = 'fechaRegistro';
    const UPDATED_AT = 'fechaModifico';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'idParametroConfiguracion',
        'idCliente',
        'valor',
        'idUsuarioRegistro',
        'idUsuarioModifico',
        'fechaRegistro',
        'fechaModifico',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fechaRegistro' =>  'string',
        'fechaModifico' =>  'string',
        'idParametroConfiguracion' => EnumParametroConfiguracion::class,
        'valor' => 'integer'
    ];

    public function parametro(){
        return $this->hasOne('App\Models\V2\ParametroConfiguracion','id','idParametroConfiguracion');
    }

}
