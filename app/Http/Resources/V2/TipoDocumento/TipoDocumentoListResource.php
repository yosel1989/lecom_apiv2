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
            'nombreCorto'          => $this->getNombreCorto()->value(),
            'numeroDigitos'       => $this->getNumeroDigitos()->value(),
            'aplFactura'       => (boolean)$this->getAplFactura()->value(),
            'aplBoleta'       => (boolean)$this->getAplBoleta()->value(),
            'aplPasajero'       => (boolean)$this->getAplPasajero()->value(),
        ];

    }
}
