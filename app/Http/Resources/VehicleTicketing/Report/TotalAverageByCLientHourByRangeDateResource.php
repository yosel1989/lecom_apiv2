<?php

namespace App\Http\Resources\VehicleTicketing\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class TotalAverageByCLientHourByRangeDateResource extends JsonResource
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
            'hora' => $this->getHour()->value(),
            'monto' => $this->getAverageAmount()->value(),
        ];
    }
}
