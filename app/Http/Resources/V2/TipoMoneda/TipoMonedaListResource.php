<?php

namespace App\Http\Resources\V2\TipoMoneda;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoMonedaListResource extends JsonResource
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
            'simbolo'          => $this->getSimbolo()->value(),
            'valor'       => $this->getValor()->value(),
        ];

    }
}
