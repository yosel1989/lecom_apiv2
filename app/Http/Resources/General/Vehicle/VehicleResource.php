<?php

namespace App\Http\Resources\General\Vehicle;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                    => $this->getId()->value(),
            'plate'                  => $this->getPlate()->value(),
            'unit'                  => $this->getUnit()->value(),
            'deleted'              => $this->getDeleted()->value(),
            'id_client'             => $this->getIdClient()->value(),
            'id_category'                  => $this->getIdCategory()->value(),
            'id_model'               => $this->getIdModel()->value(),
            'id_class'              => $this->getIdClass()->value(),
        ];
    }
}
