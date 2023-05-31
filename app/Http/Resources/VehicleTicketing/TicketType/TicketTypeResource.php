<?php

namespace App\Http\Resources\VehicleTicketing\TicketType;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketTypeResource extends JsonResource
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
            'id'        => $this->getId()->value(),
            'type'      => $this->getType()->value(),
            'code'      => $this->getCode()->value(),
        ];

    }
}
