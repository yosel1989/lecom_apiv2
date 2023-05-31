<?php

namespace App\Http\Resources\Cold\ColdMachineAlert;

use Illuminate\Http\Resources\Json\JsonResource;

class ColdMachineAlertResource extends JsonResource
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
            'code'  => $this->getCode()->value(),
            'text'  => $this->getText()->value(),
            'description' => $this->getDescription()->value(),
            'idUserCreated' => $this->getIdUserCreated()->value(),
            'idUserUpdated' => $this->getIdUserUpdated() ? $this->getIdUserUpdated()->value() : null,
            'createdAt' => $this->getDateCreated() ? $this->getDateCreated()->value() : null,
            'updatedAt' => $this->getDateUpdated() ? $this->getDateUpdated()->value() : null,
        ];

    }
}
