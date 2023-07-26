<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class TipoSerie extends Model
{
    public $incrementing = true;

    protected $table = "tipo_serie";
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


}
