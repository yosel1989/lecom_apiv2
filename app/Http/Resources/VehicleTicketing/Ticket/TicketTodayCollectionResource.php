<?php

namespace App\Http\Resources\VehicleTicketing\Ticket;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TicketTodayCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
