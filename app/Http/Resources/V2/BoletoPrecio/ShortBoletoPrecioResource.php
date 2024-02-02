<?php

namespace App\Http\Resources\V2\BoletoPrecio;

use Illuminate\Http\Resources\Json\JsonResource;

class ShortBoletoPrecioResource extends JsonResource
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
            'idParaderoOrigen'           => $this->getIdParaderoOrigen()->value(),
            'paraderoOrigen'           => $this->getParaderoOrigen()->value(),
            'idParaderoDestino'           => $this->getIdParaderoDestino()->value(),
            'paraderoDestino'           => $this->getParaderoDestino()->value(),
            'precioBase'          => $this->getPrecioBase()->value(),
            'idEstado'            => $this->getIdEstado()->value(),
            'predeterminado'            => $this->getPredeterminado()->value(),
        ];
    }
}
