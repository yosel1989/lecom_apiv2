<?php

namespace App\Http\Resources\VehicleTicketing\Ticket;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketByVehicleByDateResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $type = $this->getType();
        $price = $this->getPrice();

        // Map Domain User model values
        return [
            'id'                    => $this->getId()->value(),
            'numeroBoleto'                  => $this->getCode()->value(),
            'fecha'                  => $this->getDate()->value(),
            'latitud'              => $this->getLatitude()->value(),
            'longitud'             => $this->getLongitude()->value(),
            'vuelta'                  => $this->getTurn()->value(),
            'tipo'                  => is_null($type) ? $type : $type->getType()->value(),
            'precio'                 => is_null($price) ? $price : $price->getPrice()->value()
        ];

    }
}
