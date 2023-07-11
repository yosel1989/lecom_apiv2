<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    public $incrementing = true;

    protected $table = "tipo_documento";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombre',
        'numeroDigitos'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'numeroDigitos' =>  'integer'
    ];

}
