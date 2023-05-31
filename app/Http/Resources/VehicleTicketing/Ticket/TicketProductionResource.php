<?php

namespace App\Http\Resources\VehicleTicketing\Ticket;

use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketProductionResource extends JsonResource
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

        $date = new \DateTime($this->getDate()->value());


        // Map Domain User model values
        return [
            'date'                  => $date->format('Y-m-d'),
            'turn'                  => $this->getTurn()->value(),
            'client'                => is_null($client) ? $client : [
                'id'    => $client->getId()->value(),
                'business_name'    => $client->getBussinessName()->value(),
            ],
            'vehicle'               => is_null($vehicle) ? $vehicle : [
                'id'    => $vehicle->getId()->value(),
                'plate' => $vehicle->getPlate()->value(),
                'unit'  => $vehicle->getUnit()->value(),
            ],
            'count' => $this->getCount()->value(),
            'total'                 => $this->getTotal()->value()
        ];

    }
}
