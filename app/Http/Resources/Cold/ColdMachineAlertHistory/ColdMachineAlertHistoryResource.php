<?php

namespace App\Http\Resources\Cold\ColdMachineAlertHistory;

use Illuminate\Http\Resources\Json\JsonResource;

class ColdMachineAlertHistoryResource extends JsonResource
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
            'id'    => $this->getId()->value(),
            'idAlert'  => $this->getAlertId()->value(),
            'idMachine'  => $this->getMachineId()->value(),
            'attended' => $this->getAttended()->value(),
            'idUserUpdated' => $this->getIdUserUpdated() ? $this->getIdUserUpdated()->value() : null,
            'latitude' => $this->getLatitude()->value(),
            'longitude' => $this->getLongitude()->value(),
            'createdAt' => $this->getDateCreated() ? $this->getDateCreated()->value() : null,
            'updatedAt' => $this->getDateUpdated() ? $this->getDateUpdated()->value() : null,
        ];

    }
}
