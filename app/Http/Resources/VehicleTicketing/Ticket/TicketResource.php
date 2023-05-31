<?php

namespace App\Http\Resources\VehicleTicketing\Ticket;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
        $type = $this->getType();
        $machine = $this->getMachine();
        $vehicle = $this->getVehicle();
        $price = $this->getPrice();

        // Map Domain User model values
        return [
            'id'                    => $this->getId()->value(),
            'code'                  => $this->getCode()->value(),
            'date'                  => $this->getDate()->value(),
            'latitude'              => $this->getLatitude()->value(),
            'longitude'             => $this->getLongitude()->value(),
            'turn'                  => $this->getTurn()->value(),
            'deleted'               => $this->getDeleted()->value() ? true : false,
            'client'                => is_null($client) ? $client : [
                'id'    => $client->getId()->value(),
                'business_name'    => $client->getBussinessName()->value(),
            ],
            'vehicle'               => is_null($vehicle) ? $vehicle : [
                'id'    => $vehicle->getId()->value(),
                'plate' => $vehicle->getPlate()->value(),
                'unit'  => $vehicle->getUnit()->value(),
            ],
            'machine'               => is_null($machine) ? $machine : [
                'id'    => $machine->getId()->value(),
                'imei'  => $machine->getImei()->value(),
            ],
            'type'                  => is_null($type) ? $type : $type->getType()->value(),
            'price'                 => is_null($price) ? $price : $price->getPrice()->value()
        ];

    }
}
