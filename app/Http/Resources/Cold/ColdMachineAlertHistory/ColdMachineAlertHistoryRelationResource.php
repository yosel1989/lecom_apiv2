<?php

namespace App\Http\Resources\Cold\ColdMachineAlertHistory;

use Illuminate\Http\Resources\Json\JsonResource;

class ColdMachineAlertHistoryRelationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $alert = $this->getAlert();
        $machine = $this->getMachine();
        // Map Domain User model values
        return [
            'id'    => $this->getId()->value(),
            'idMachine'  => $this->getMachineId()->value(),
            'attended' => $this->getAttended()->value(),
            'idUserUpdated' => $this->getIdUserUpdated() ? $this->getIdUserUpdated()->value() : null,
            'latitude' => $this->getLatitude()->value(),
            'longitude' => $this->getLongitude()->value(),
            'createdAt' => $this->getCreatedAt() ? $this->getCreatedAt()->value() : null,
            'updatedAt' => $this->getDateUpdated() ? $this->getDateUpdated()->value() : null,
            'alert' => is_null($alert) ? null : [
                'id' => $alert->getId()->value(),
                'name' => $alert->getText()->value(),
                'description' => $alert->getDescription()->value()
            ],
            'machine' => is_null($machine) ? null : [
                'id' => $machine->getId()->value(),
                'imei' => $machine->getImei()->value(),
                'sim' => $machine->getSim()->value()
            ]
        ];

    }
}
