<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ErtCategoria extends Model
{

    use SoftDeletes;


    public $timestamps = true;
    protected $softDelete = true;


    protected $table        = "ert_categoria";
    protected $primaryKey  = "categoria_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoria_id',
        'padre_id',
        'orden_cat',
        'cliente_id',
        'categoria_nombre',
        'categoria_descripcion',
        'categoria_icono',
        'categoria_expanded',
        'categoria_group',
        'categoria_borrar',
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
