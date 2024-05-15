<?php

namespace App\Http\Resources\V2\ClienteMedioPago;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteMedioPagoResource extends JsonResource
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
            'idMedioPago'            => $this->getIdMedioPago()->value(),
            'medioPago'            => $this->getMedioPago()->value(),
            'idTipo'            => $this->getIdTipo()->value(),
            'tipo'            => $this->getTipo()->value(),
            'usuarioRegistro'          => $this->getUsuarioRegistro()->value(),
            'fechaRegistro'          => $this->getFechaRegistro()->value(),
            'blActivado'          => $this->getActivado()->value(),
        ];

    }
}
