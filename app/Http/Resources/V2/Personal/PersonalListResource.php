<?php

namespace App\Http\Resources\V2\Personal;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonalListResource extends JsonResource
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
            'idSede'       => $this->getIdSede()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),
            'tipoPersonal'       => $this->getTipoPersonal()->value(),
            'numeroDocumento'       => $this->getNumeroDocumento()->value(),
            'foto'       => $this->getFoto()->value() ? asset($this->getFoto()->value()) : null,

        ];

    }
}
