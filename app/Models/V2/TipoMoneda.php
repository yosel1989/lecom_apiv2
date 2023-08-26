<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class TipoMoneda extends Model
{
    public $incrementing = true;

    protected $table = "tipo_moneda";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombre',
        'abreviatura'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];
}
