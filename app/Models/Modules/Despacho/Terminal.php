<?php

namespace App\Models\Modules\Despacho;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terminal extends Model
{

    use SoftDeletes;

    public $timestamps = true;
    protected $softDelete = true;


    protected $table        = "des_terminales";
    protected $primaryKey  = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nombre',
        'cliente_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
}
