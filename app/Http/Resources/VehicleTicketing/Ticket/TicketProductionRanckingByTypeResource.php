<?php

namespace App\Http\Resources\VehicleTicketing\Ticket;

use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketProductionRanckingByTypeResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $client = $this->getClient();
        $vehicle = $this->getVehicle();
        $type = $this->getType();

        $date = new \DateTime($this->getDate()->value());


        // Map Domain User model values
        return [
            'date'                  => $date->format('Y-m-d'),
            'client'                => is_null($client) ? $client : [
                'id'    => $client->getId()->value(),
                'business_name'    => $client->getBussinessName()->value(),
            ],
            'vehicle'               => is_null($vehicle) ? $vehicle : [
                'id'    => $vehicle->getId()->value(),
                'plate' => $vehicle->getPlate()->value(),
                'unit'  => $vehicle->getUnit()->value(),
            ],
            'type'               => is_null($type) ? $type : [
                'id'    => $type->getId()->value(),
                'type'  => $type->getType()->value(),
            ],
            'total'                 => $this->getTotal()->value()
        ];

    }
}
