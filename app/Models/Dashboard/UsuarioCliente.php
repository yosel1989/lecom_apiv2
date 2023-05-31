<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class UsuarioCliente extends Model
{
    public $timestamps = true;
    protected $softDelete = true;


    protected $table = "rel_usuario_cliente";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente_id',
        'usuario_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];

    public function users(){
        return $this->hasMany('App/User','usuario_id','usuario_id');
    }

}

