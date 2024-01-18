<?php

namespace App\Models\V2;

use Illuminate\Database\Eloquent\Model;

class OrigenBoleto extends Model
{
//    use UUID;

    protected $table = "origen_boleto";
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
