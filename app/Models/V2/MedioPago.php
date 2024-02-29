<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class MedioPago extends Model
{
    public $incrementing = true;

    protected $table = "medio_pago";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'bl_despacho',
        'bl_entidad_financiera',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'bl_despacho' =>  'bool',
        'bl_entidad_financiera' =>  'bool',
    ];


}
