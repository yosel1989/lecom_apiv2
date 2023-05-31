<?php

namespace App\Http\Resources\VehicleTicketing\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketsByVehicleResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getIdTicket()->value(),
            'numeroBoleto' => $this->getCode()->value(),
            'numeroVuelta' => $this->getTurn()->value(),
            'latitud' => $this->getLatitude()->value(),
            'longitud' => $this->getLongitude()->value(),
            'fecha' => $this->getDate()->value(),
            'monto' => $this->getAmount()->value(),
        ];
    }
}
