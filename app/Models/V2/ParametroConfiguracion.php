<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class ParametroConfiguracion extends Model
{
    public $incrementing = true;

    protected $table = "parametros_configuracion";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombre',
        'descripcion'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];
}
