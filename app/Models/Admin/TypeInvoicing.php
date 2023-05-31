<?php

namespace App\Models\Admin;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class TypeInvoicing extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "acc_invoicing_types";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'months',
        'deleted'
    ];

    protected $casts = [
        'months'      => 'integer',
        'deleted'      => 'integer'
    ];
}
