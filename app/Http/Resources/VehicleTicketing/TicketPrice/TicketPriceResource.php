<?php

namespace App\Http\Resources\VehicleTicketing\TicketPrice;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketPriceResource extends JsonResource
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
            'code'      => $this->getCode()->value(),
            'price'      => $this->getPrice()->value(),
            'actived'      => $this->getActived()->value() ? true : false,
            'deleted'      => $this->getDeleted()->value() ? true : false,
            'idClient'      => $this->getIdClient()->value(),
        ];

    }
}
