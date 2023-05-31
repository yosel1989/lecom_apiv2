<?php

namespace App\Models\VehicleTicketing;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    protected $table = "btj_ticket_types";

    protected $fillable = [
        'id',
        'type',
        'code',
    ];

    protected $casts = [
        'code'      => 'integer',
    ];
}
