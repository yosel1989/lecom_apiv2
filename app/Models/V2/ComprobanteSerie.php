<?php

namespace App\Models\V2;

use App\Enums\EnumTipoComprobante;
use App\Enums\IdEstado;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class ComprobanteSerie extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "ce_serie";
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
        'nombre',
        'idCliente',
        'idSede',
        'idTipoComprobante',
        'idEstado',
        'idUsuarioRegistro',
        'idUsuarioModifico',
        'fechaRegistro',
        'fechaModifico'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fechaRegistro' =>  'string',
        'fechaModifico' =>  'string',
        'idTipoComprobante' =>  EnumTipoComprobante::class,
        'idEstado' =>  IdEstado::class,
    ];

    public function sede(){
        return $this->hasOne('App\Models\V2\Sede','id','idSede');
    }

    public function tipoComprobante(){
        return $this->hasOne('App\Models\V2\TipoComprobante','id','idTipoComprobante');
    }

    public function usuarioRegistro(){
        return $this->hasOne('App\Models\User','id','idUsuarioRegistro');
    }

    public function usuarioModifico(){
        return $this->hasOne('App\Models\User','id','idUsuarioModifico');
    }

}
