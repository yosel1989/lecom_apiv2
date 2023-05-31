<?php

namespace App\Http\Resources\VehicleTicketing\TicketMachine;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketMachineResource2 extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $vehicle = $this->getVehicle();
        $userCreated = $this->getUserCreated();
        $userUpdated = $this->getUserUpdated();
        // Map Domain User model values
        return [
            'id'            => $this->getId()->value(),
            'imei'          => $this->getImei()->value(),
            'deleted'       => $this->getDeleted()->value(),
            'idClient'      => $this->getIdClient()->value(),
            'idVehicle'     => $this->getIdVehicle()->value(),
            'vehicle'     => !is_null($vehicle) ? $vehicle->getPlate()->value() : null,
            'idUserCreated'     => $this->getIdUserCreated()->value(),
            'idUserUpdated'     => $this->getIdUserUpdated()->value(),
            'userCreated'     => !is_null($userCreated) ? ($userCreated->getFirstName()->value() . ' ' . $userCreated->getLastName()->value()) : null,
            'userUpdated'     => !is_null($userUpdated) ? ($userUpdated->getFirstName()->value() . ' ' . $userUpdated->getLastName()->value()) : null,
            'createdAt'     => $this->getCreatedAt()->value(),
            'updatedAt'     => $this->getUpdatedAt()->value(),
        ];

    }
}
