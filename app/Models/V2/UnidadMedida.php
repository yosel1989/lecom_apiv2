<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    public $incrementing = true;

    protected $table = "unidad_medida";
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
