<?php

namespace App\Http\Resources\V2\Caja;

use Illuminate\Http\Resources\Json\JsonResource;

class CajaSedeResource extends JsonResource
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
            'idSede'          => $this->getIdSede()->value(),
            'aperturado'          => $this->getAperturado()->value(),
            'idCajaHistorial'     => $this->getAperturado()->value() ? $this->getIdCajaDiario()->value() : null,
        ];
    }
}
