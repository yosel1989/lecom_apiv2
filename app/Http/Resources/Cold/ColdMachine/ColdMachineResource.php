<?php

namespace App\Http\Resources\Cold\ColdMachine;

use Illuminate\Http\Resources\Json\JsonResource;

class ColdMachineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $model = $this->getModel();
        // Map Domain User model values
        return [
            'id'    => $this->getId()->value(),
            'imei'  => $this->getImei()->value(),
            'idModel'  => $this->getIdModel()->value(),
            'idClient' => $this->getIdClient()->value(),
            'idStatus' => $this->getIdStatus()->value(),
            'setPoint' => $this->getSetPoint()->value(),
            'maxFuel' => $this->getMaxFuel()->value(),
            'sim' => $this->getSim()->value(),
            'model' => $model ? [
                'id' => $this->getIdModel()->value(),
                'name' => $model->getName()->value()
            ] : null,
            'idUserCreated' => $this->getIdUserCreated()->value(),
            'idUserUpdated' => $this->getIdUserUpdated() ? $this->getIdUserUpdated()->value() : null,
            'createdAt' => $this->getDateCreated() ? $this->getDateCreated()->value() : null,
            'updatedAt' => $this->getDateUpdated() ? $this->getDateUpdated()->value() : null,
        ];

    }
}
