<?php

namespace App\Models\TransporteInterprovincial;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "tpi_destino";

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
        'precioBase',
        'idCliente',
        'idEstado',
        'idEliminado',
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
        'precioBase' => 'float',
        'fechaRegistro' => 'datetime',
        'fechaModifico' => 'datetime',
        'idEstado' => IdEstado::class,
        'idEliminado' => IdEliminado::class,
    ];

}
