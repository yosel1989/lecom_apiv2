<?php

namespace App\Http\Resources\Cold\ColdMachineHistory;

use Illuminate\Http\Resources\Json\JsonResource;

class LevelFuelHistoryResource extends JsonResource
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
            'levelFuel' => $this->getLevelFuel()->value(),
            'latitude'  => $this->getLatitude()->value(),
            'longitude' => $this->getLongitude()->value(),
            'createdAt' => $this->getCreatedAt()->value()
        ];

    }
}
