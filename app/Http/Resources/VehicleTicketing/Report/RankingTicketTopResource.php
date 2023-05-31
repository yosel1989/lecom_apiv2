<?php

namespace App\Http\Resources\VehicleTicketing\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class RankingTicketTopResource extends JsonResource
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
            'precio' => $this->getPrice()->value(),
            'recaudoTotal' => $this->getTotalAmount()->value(),
        ];
    }
}
