<?php

namespace App\Http\Resources\VehicleTicketing\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class TotalByVehicleByTurnResource extends JsonResource
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
            'numeroVuelta' => $this->getTurn()->value(),
            'numeroBoletos' => $this->getTotalTicket()->value(),
            'recaudoTotal' => $this->getTotalAmount()->value(),
        ];
    }
}
