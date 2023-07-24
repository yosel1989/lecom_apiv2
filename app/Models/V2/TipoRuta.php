<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class TipoRuta extends Model
{
    public $incrementing = true;

    protected $table = "tipos_ruta";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
