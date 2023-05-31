<?php

namespace App\Http\Resources\Administracion\TipoEgreso;

use Illuminate\Http\Resources\Json\JsonResource;

class ListResource extends JsonResource
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
            'registraVehiculo'       => (boolean)$this->getRegistraVehiculo()->value(),
            'registraPersonal'       => (boolean)$this->getRegistraPersonal()->value(),
            'registraRuta'       => (boolean)$this->getRegistraRuta()->value(),
            'idCliente'       => $this->getIdCliente()->value(),
            'idEstado'     => $this->getIdEstado()->value(),
        ];

    }
}
