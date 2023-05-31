<?php

namespace App\Http\Resources\VehicleTicketing\Ticket;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TicketsTodayByVehicleResource extends ResourceCollection
{

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $count = $this->collection->count() ;
        $price_total = $count ? $this->collection->sum(function($ticket) { return $ticket->getPrice()->getPrice()->value(); }) : 0;
        $turn_actual = $count ? $this->collection->last()->getTurn()->value() : 1;

        return [
            'data' => TicketResource::collection($this->collection),
            'count' => $count,
            'ptotal' => $price_total,
            'turn' => $turn_actual
        ];

    }

}
