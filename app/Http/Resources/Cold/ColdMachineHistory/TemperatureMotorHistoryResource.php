<?php

namespace App\Http\Resources\Cold\ColdMachineHistory;

use Illuminate\Http\Resources\Json\JsonResource;

class TemperatureMotorHistoryResource extends JsonResource
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
            'temperatureMotor' => $this->getTemperatureMotor() ? $this->getTemperatureMotor()->value() : null,
            'latitude'  => $this->getLatitude()->value(),
            'longitude' => $this->getLongitude()->value(),
            'createdAt' => $this->getCreatedAt()->value()
        ];

    }
}
