<?php

namespace App\Models\VehicleTicketing;

use App\MyCustom\Eloquent\SoftDeletesBoolean;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use SoftDeletesBoolean;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = true;
    const DELETED = 'deleted';

    protected $dateFormat = 'U';

    protected $table = "btj_tickets";

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'code',
        'date',
        'latitude',
        'longitude',
        'turn',
        'deleted',
        'id_client',
        'id_vehicle',
        'id_ticket_machine',
        'id_ticket_price',
        'id_ticket_type',
        'document_personal',
        'reserved',
        'id_route',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id'     => 'string',
        'latitude'     => 'float',
        'longitude'    => 'float',
        'turn'      => 'integer',
        'deleted'      => 'integer',
        'reserved'      => 'date:Y-m-d',
        'created_at'      => 'datetime:Y-m-d H:i:s',
        'updated_at'      => 'datetime:Y-m-d H:i:s',
    ];

    public function idClient_pk(){
        return $this->belongsTo('App\Models\Auth\Client','id_client');
    }

    public function idVehicle_pk(){
        return $this->belongsTo('App\Models\General\Vehicle','id_vehicle');
    }

    public function idMachine_pk(){
        return $this->belongsTo('App\Models\VehicleTicketing\TicketMachine','id_ticket_machine');
    }

    public function idPrice_pk(){
        return $this->belongsTo('App\Models\VehicleTicketing\TicketPrice','id_ticket_price');
    }

    public function idType_pk(){
        return $this->belongsTo('App\Models\VehicleTicketing\TicketType','id_ticket_type');
    }

    public function route(){
        return $this->hasOne('App\Models\Administracion\Ruta','id','id_route');
    }
}
