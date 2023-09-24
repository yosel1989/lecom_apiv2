<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = "ubigeo";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'departamento',
        'provincia',
        'distrito',
    ];

}
