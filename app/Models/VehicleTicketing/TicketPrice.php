<?php

namespace App\Models\VehicleTicketing;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class TicketPrice extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED = 'deleted';

    protected $table = "btj_ticket_prices";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'code',
        'price',
        'actived',
        'deleted',
        'id_client',
        'distance',
    ];

    protected $casts = [
        'code'         => 'integer',
        'price'        => 'float',
        'actived'      => 'integer',
        'deleted'      => 'integer',
        'distance'      => 'integer',
    ];

}
