<?php

namespace App\Http\Resources\V2\BoletoInterprovincial;

use Illuminate\Http\Resources\Json\JsonResource;

class PasajeroResource extends JsonResource
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
            'nombre'            => $this->getNombre()->value(),
            'apellido'       => $this->getApellido()->value(),
            'tipoDocumento'       => $this->getTipoDocumento()->value(),
            'numeroDocumento'       => $this->getNumeroDocumento()->value(),
            'destino'       => $this->getDestino()->value(),
            'fechaPartida'       => $this->getFechaPartida()->value(),
            'horaPartida'       => $this->getHoraPartida()->value(),
        ];

    }
}
