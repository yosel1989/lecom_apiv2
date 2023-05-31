<?php

namespace App\Http\Resources\Admin\Gps;

use Illuminate\Http\Resources\Json\JsonResource;

class GpsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $model = $this->getGpsModel();
        $client = $this->getClient();
        // Map Domain User model values
        return [
            'id'   => $this->getId()->value(),
            'imei' => $this->getImei()->value(),
            'type' => $this->getType()->value(),
            'client' => [
                'id' => $client->getId()->value(),
                'name' => $client->getBussinessName()->value()
            ],
            'model' => [
                'id' => $model->getId()->value(),
                'name' => $model->getName()->value()
            ]
        ];

    }
}
