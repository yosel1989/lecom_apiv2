<?php

namespace App\Http\Resources\Cold\ColdMachineModel;

use Illuminate\Http\Resources\Json\JsonResource;

class ColdMachineModelResource extends JsonResource
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
            'name'  => $this->getName()->value(),
            'shortName'  => $this->getShortName()->value(),
            'idType' => $this->getIdType()->value(),
            'code' => $this->getCode()->value(),
            'idUserCreated' => $this->getIdUserCreated()->value(),
            'idUserUpdated' => $this->getIdUserUpdated() ? $this->getIdUserUpdated()->value() : null,
            'createdAt' => $this->getDateCreated() ? $this->getDateCreated()->value() : null,
            'updatedAt' => $this->getDateUpdated() ? $this->getDateUpdated()->value() : null,
        ];

    }
}
