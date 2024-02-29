<?php

namespace App\Http\Resources\V2\MedioPago;

use Illuminate\Http\Resources\Json\JsonResource;

class MedioPagoResource extends JsonResource
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
            'blDespacho'          => $this->getBlDespacho()->value(),
            'blEntidadFinanciera'          => $this->getBlEntidadFinanciera()->value(),
        ];

    }
}
