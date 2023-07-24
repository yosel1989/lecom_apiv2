<?php

namespace App\Http\Resources\V2\Paradero;

use Illuminate\Http\Resources\Json\JsonResource;

class ShortParaderoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id'                  => $this->getId()->value(),
            'nombre'              => $this->getNombre()->value(),
            'precioBase'          => $this->getPrecioBase()->value(),
            'idRuta'            => $this->getIdRuta()->value(),
            'idEstado'            => $this->getIdEstado()->value(),
        ];
    }
}
