<?php

namespace App\Http\Resources\V2\Vehiculo;

use Illuminate\Http\Resources\Json\JsonResource;

class VehiculoListResource extends JsonResource
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
            'id'            => $this->getId()->value(),
            'placa'          => $this->getPlaca()->value(),
            'unidad'       => $this->getUnidad()->value(),
        ];

    }
}
