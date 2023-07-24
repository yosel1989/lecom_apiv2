<?php

namespace App\Http\Resources\V2\TipoDocumento;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoDocumentoListResource extends JsonResource
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
            'numeroDigitos'       => $this->getNumeroDigitos()->value(),
        ];

    }
}
