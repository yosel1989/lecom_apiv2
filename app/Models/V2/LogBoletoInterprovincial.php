<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class LogBoletoInterprovincial extends Model
{

    protected $table = "log_boleto_interprovincial";
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'motivo',
        'descripcion'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' =>  'string',
        'updated_at' =>  'string',
    ];


}
