<?php

namespace App\Http\Resources\V2\Egreso;

use Illuminate\Http\Resources\Json\JsonResource;

class EgresoListResource extends JsonResource
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
            'idPersonal'          => $this->getIdPersonal()->value(),
            'personal'          => $this->getPersonal()->value(),
            'idVehiculo'          => $this->getIdVehiculo()->value(),
            'vehiculo'          => $this->getVehiculo()->value(),
            'total'          => $this->getTotal()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),
        ];

    }
}
