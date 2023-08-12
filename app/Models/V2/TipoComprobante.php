<?php

namespace App\Models\V2;

use App\Enums\EnumPuntoVenta;
use Illuminate\Database\Eloquent\Model;

class TipoComprobante extends Model
{
    public $incrementing = true;

    protected $table = "tipo_comprobante";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombre',
        'blPuntoVenta',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'blPuntoVenta' => EnumPuntoVenta::class,

    ];

}
