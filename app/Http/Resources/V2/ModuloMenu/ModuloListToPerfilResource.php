<?php

namespace App\Http\Resources\V2\Modulo;

use Illuminate\Http\Resources\Json\JsonResource;

class ModuloListToPerfilResource extends JsonResource
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
            'icono'          => $this->getIcono()->value(),
            'link'          => $this->getLink()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),
            'activado'       => $this->isActivado(),
        ];
    }
}
