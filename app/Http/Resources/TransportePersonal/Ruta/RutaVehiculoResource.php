<?php

namespace App\Http\Resources\TransportePersonal\Ruta;

use Illuminate\Http\Resources\Json\JsonResource;

class RutaVehiculoResource extends JsonResource
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
            'idRuta'  => $this->getIdRuta()->value(),
            'ruta'  => $this->getRuta()->value(),
            'idVehiculo'  => $this->getIdVehiculo()->value(),
            'vehiculo'      => $this->getVehiculo()->value()
        ];

    }
}
