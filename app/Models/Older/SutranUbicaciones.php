<?php

namespace App\Models\Older;

use Illuminate\Database\Eloquent\Model;

class SutranUbicaciones extends Model
{
    //protected $keyType = 'string';
    //public $incrementing = false;

    public $timestamps = false;
    protected $table = "sutran_ubicaciones";

    protected $connection = 'mysql2';
    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'placa',
        'latitud',
        'longitud',
        'rumbo',
        'velocidad',
        'evento',
        'fechaemv',
        'fecha',
        'tms'
    ];
}
