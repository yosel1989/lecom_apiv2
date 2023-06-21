<?php

namespace App\Models\TransporteInterprovincial;

use App\Traits\TableNameDynamic;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class BoletoCliente extends Model
{
    use UUID;
    use TableNameDynamic;

    protected $keyType = 'string';
    public $incrementing = false;

    const CREATED_AT = 'fechaRegistro';
    const UPDATED_AT = 'fechaModifico';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'idDestino',
        'idVehiculo',
        'idCliente',
        'numeroDocumento',
        'serie',
        'numeroBoleto',
        'latitud',
        'longitud',
        'precio',
        'fecha',
        'fechaRegistro',
        'fechaModifico',
        'idUsuarioRegistro',
        'idUsuarioModifico',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'precio' => 'float',
        'latitud' => 'float',
        'longitud' => 'float',
        'fecha' => 'datetime',
        'fechaRegistro' => 'datetime',
        'fechaModifico' => 'datetime'
    ];

}
