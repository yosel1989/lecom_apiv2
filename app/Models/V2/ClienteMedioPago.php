<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class ClienteMedioPago extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "cliente_medio_pago";
    public $timestamps = false;


    protected $fillable = [
        'id_cliente',
        'id_medio_pago',
        'id_usu_registro',
        'f_registro',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id_medio_pago' =>  'int',
        'f_registro' =>  'string',
    ];


}
