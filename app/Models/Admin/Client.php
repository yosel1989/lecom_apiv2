<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\MyCustom\Eloquent\SoftDeletesBoolean;

class Client extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "clients";

    /**
     *  Type Client:
     *  0 => Cliente Reseller
     *  1 => Cliente Final
     */

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'bussiness_name',
        'first_name',
        'last_name',
        'ruc',
        'dni',
        'email',
        'address',
        'phone',
        'type',
        'deleted',
        'id_parent_client',
    ];

    protected $casts = [
        'deleted'   => 'integer',
        'type'      => 'integer',
    ];

    public function modules(){
        return $this->belongsToMany('App\Models\System\Module','client_modules','id_client','id_module','id','id');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\Admin\Client','id_parent_client');
    }
}
