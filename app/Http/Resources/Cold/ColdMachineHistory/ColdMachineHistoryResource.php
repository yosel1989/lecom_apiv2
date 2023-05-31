<?php

namespace App\Http\Resources\Cold\ColdMachineHistory;

use Illuminate\Http\Resources\Json\JsonResource;

class ColdMachineHistoryResource extends JsonResource
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
            'type'  => $this->getType()->value(),
            'imei'  => $this->getImei()->value(),
            'idMachine'  => $this->getIdMachine()->value(),
            'status'  => $this->getStatus()->value(),
            'levelBattery' => $this->getLevelBattery()->value(),
            'levelFuel' => $this->getLevelFuel()->value(),
            'levelOutput' => $this->getLevelOutput()->value(),
            'frequencyOutput' => $this->getFrequencyOutput()->value(),
            'temperatureMotor' => $this->getTemperatureMotor()->value(),
            'hourmeter' => $this->getHourmeter()->value(),
            'temeperatureSupply' => $this->getTemperatureSupply()->value(),
            'temperatureReturn' => $this->getTemperatureReturn()->value(),
            'humididty' => $this->getHumidity()->value(),
            'co2' => $this->getCo2()->value(),
            'spTemperature' => $this->getSpTemperature()->value(),
            'spCo2' => $this->getSpCo2()->value(),
            'spHumidity' => $this->getSpHumidity()->value(),
            'idClient' => $this->getClientId()->value(),
            'latitude' => $this->getLatitude()->value(),
            'longitude' => $this->getLongitude()->value(),
            'createdAt' => $this->getCreatedAt()->value()
        ];

    }
}
