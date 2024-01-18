<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
//    use UUID;

    protected $table = "acciones";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nombre',
        'entidad',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

}
