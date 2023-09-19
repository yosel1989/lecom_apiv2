<?php

namespace App\Models\V2;

use App\Enums\EnumPuntoVenta;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    public $incrementing = true;

    protected $table = "tipo_pago";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombre',
        'valor',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

}
