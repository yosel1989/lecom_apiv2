<?php

namespace App\Http\Resources\V2\Sede;

use Illuminate\Http\Resources\Json\JsonResource;

class RutaSedeListResource extends JsonResource
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
            'codigo'          => $this->getCodigo()->value(),
//            'direccion'          => $this->getDireccion()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),
            'selected'       => $this->getSelected()->value(),

        ];

    }
}
