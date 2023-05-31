<?php

namespace App\Http\Resources\VehicleTicketing\TicketMachine;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketMachineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Map Domain User model values
        return [
            'id'            => $this->getId()->value(),
            'imei'          => $this->getImei()->value(),
            'deleted'       => $this->getDeleted()->value(),
            'idClient'      => $this->getIdClient()->value(),
            'idVehicle'     => $this->getIdVehicle()->value(),
        ];

    }
}
