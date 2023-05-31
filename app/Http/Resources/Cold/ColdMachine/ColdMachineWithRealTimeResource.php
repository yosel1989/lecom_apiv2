<?php

namespace App\Http\Resources\Cold\ColdMachine;

use App\Http\Resources\Cold\ColdMachineHistory\ColdMachineHistoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ColdMachineWithRealTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $realTime = $this->getRealTime();
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
                'id' => $this->getId()->value(),
                'name' => $model->getName()->value(),
                'type' => $model->getIdType()->value()
            ] : null,
            'realTime' => $realTime ? ColdMachineHistoryResource::make($realTime) : null
        ];

    }
}
