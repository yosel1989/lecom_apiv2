<?php

namespace App\Http\Resources\Administracion\PersonalCategoria;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionShortResource extends JsonResource
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
            'codigo'       => $this->getCodigo()->value(),
            'idEstado'     => $this->getIdEstado()->value(),
        ];

    }
}
