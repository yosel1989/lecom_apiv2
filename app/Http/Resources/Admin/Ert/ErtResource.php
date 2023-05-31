<?php

namespace App\Http\Resources\Admin\Ert;

use Illuminate\Http\Resources\Json\JsonResource;

class ErtResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $client = $this->getClient();
        $vehicle = $this->getVehicle();
        $simCard = $this->getSimCard();
        $gps = $this->getGps();

        return [
            'id'         => $this->getId()->value(),
            'period'     => $this->getPeriod()->value(),
            'sutran'     => !!$this->getSutran()->value(),
            'client'     => $client ? [
                'id' => $client->getId()->value(),
                'name' => $client->getBussinessName()->value()
            ] : null,
            'vehicle'    => $vehicle ? [
                'id' => $vehicle->getId()->value(),
                'plate' => $vehicle->getPlate()->value()
            ] : null,
            'type' => $this->getIdType()->value(),
            'gps' => $gps ? [
                'id' => $gps->getId()->value(),
                'imei' => $gps->getImei()->value(),
            ] : null,
            'simcard' => $simCard ? [
                'id' => $simCard->getId()->value(),
                'number' => $simCard->getNumber()->value(),
                'operator' => $simCard->getIdOperator()->value()
            ] : null
        ];
    }
}
