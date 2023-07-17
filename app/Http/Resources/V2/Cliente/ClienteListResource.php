<?php

namespace App\Http\Resources\V2\Cliente;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteListResource extends JsonResource
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
            'apellido'       => $this->getApellido()->value(),
            'idCliente'       => $this->getIdCliente()->value(),
            'idSede'       => $this->getIdCliente()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),

        ];

    }
}
