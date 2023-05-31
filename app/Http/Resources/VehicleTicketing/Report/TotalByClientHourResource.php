<?php

namespace App\Http\Resources\VehicleTicketing\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class TotalByClientHourResource extends JsonResource
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
            'monto' => $this->getTotalAmount()->value(),
        ];
    }
}
