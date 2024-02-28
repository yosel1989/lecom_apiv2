<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class EntidadFinanciera extends Model
{

    protected $table = "entidad_financiera";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombre',
        'id_estado'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' =>  'int',
        'id_estado' =>  'int',
    ];

}
