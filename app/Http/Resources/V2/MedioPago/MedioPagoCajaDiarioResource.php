<?php

namespace App\Http\Resources\V2\MedioPago;

use Illuminate\Http\Resources\Json\JsonResource;

class MedioPagoCajaDiarioResource extends JsonResource
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
            'nombre'          => $this->getNombre()->value(),
            'monto'          => $this->getMonto()->value(),
        ];

    }
}
