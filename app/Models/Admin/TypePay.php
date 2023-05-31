<?php

namespace App\Models\Admin;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class TypePay extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "acc_pay_types";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'currency',
        'amount',
        'deleted'
    ];

    protected $casts = [
        'months'      => 'integer',
        'deleted'      => 'integer',
        'amount'      => 'float'
    ];
}
