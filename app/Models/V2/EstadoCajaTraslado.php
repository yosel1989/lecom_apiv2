<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class EstadoCajaTraslado extends Model
{

    protected $table = "e_caja_traslado";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombre'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' =>  'int',
    ];

}
