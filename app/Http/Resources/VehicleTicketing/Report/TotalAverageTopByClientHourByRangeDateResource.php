<?php

namespace App\Http\Resources\VehicleTicketing\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class TotalAverageTopByClientHourByRangeDateResource extends JsonResource
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
            'padron' => $this->getUnit()->value(),
            'placa' => $this->getPlate()->value(),
            'propietario' => $this->getProperty()->value(),
            'numeroVueltas' => $this->getTotalTurn()->value(),
            'numeroBoletos' => $this->getTotalTicket()->value(),
            'recaudoTotal' => $this->getTotalAmount()->value(),
        ];
    }
}
