<?php

namespace App\Http\Resources\V2\TipoPersonal;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoPersonalListResource extends JsonResource
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
            'idCliente'          => $this->getIdCliente()->value(),
            'idEstado'       => $this->getIdEstado()->value(),

        ];

    }
}
