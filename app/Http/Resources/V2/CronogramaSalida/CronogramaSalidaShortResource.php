<?php

namespace App\Http\Resources\V2\CronogramaSalida;

use Illuminate\Http\Resources\Json\JsonResource;

class CronogramaSalidaShortResource extends JsonResource
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
            'idVehiculo'          => $this->getIdVehiculo()->value(),
            'vehiculo'          => $this->getVehiculo()->value(),
            'fecha'          => $this->getFecha()->value(),
            'hora'          => $this->getHora()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value()
        ];

    }
}
