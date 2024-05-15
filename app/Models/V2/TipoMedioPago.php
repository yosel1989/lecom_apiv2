<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class TipoMedioPago extends Model
{
    public $incrementing = true;

    protected $table = "medio_pago_tipo";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];


}
