<?php

namespace App\Models\Modules\Boletaje;

use App\Models\ModelBase;

class TicketType extends ModelBase
{

	protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    protected $table 		= "btj_ticket_types";

    protected $fillable 	= [
        'id',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];


    protected $guarded = [];

}
