<?php

namespace App\Models\Admin;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;


/** Marca de Vehiculos **/
class OperatorPhone extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "telephone_operators";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'deleted',
    ];

    protected $casts = [
        'deleted'      => 'integer',
    ];
}
