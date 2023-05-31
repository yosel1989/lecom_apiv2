<?php

namespace App\Models\Modules\Boletaje;

use App\Models\ModelBase;
use App\MyCustom\Eloquent\SoftDeletesBoolean;

class TicketMachine extends ModelBase
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $softDelete = true;

    const DELETED_AT = 'deleted';

    public $timestamps = false;

    protected $table 		= "btj_ticket_machines";

    protected $fillable 	= [
        'id',
        'id_vehicle',
        'id_client',
        'imei',
    ];

    protected $hidden = [
        'deleted'
    ];

}
