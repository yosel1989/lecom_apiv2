<?php

namespace App\Http\Resources\VehicleTicketing\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class TotalByVehicleDatesResource extends JsonResource
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
            'idVehiculo' => $this->getIdVehicle()->value(),
            'fecha' => $this->getDate()->value(),
            'numeroVuelta' => $this->getTurn()->value(),
            'numeroBoleto' => $this->getTotalTicket()->value(),
            'recaudoTotal' => $this->getTotalAmount()->value(),
        ];
    }
}
