<?php

namespace App\Models\Modules\Boletaje;

use App\Models\ModelBase;
use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
    const DELETED_AT = 'deleted';

    protected $table = "btj_tickets";

    protected $fillable = [
        'id',
        'id_ticket_machine',
        'id_vehicle',
        'id_client',
        'id_type',
        'code',
        'date',
        'price',
    ];

    protected $hidden = [
        'deleted'
    ];

    protected $guarded = [];
}
