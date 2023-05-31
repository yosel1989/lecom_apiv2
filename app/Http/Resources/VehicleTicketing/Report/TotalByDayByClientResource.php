<?php

namespace App\Http\Resources\VehicleTicketing\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class TotalByDayByClientResource extends JsonResource
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
            'fecha' => $this->getDate()->value(),
            'numeroVehiculos' => $this->getCountVehicle()->value(),
            'numeroBoletos' => $this->getCountTicket()->value(),
            'recaudoTotal' => $this->getTotalAmount()->value(),
        ];
    }
}
