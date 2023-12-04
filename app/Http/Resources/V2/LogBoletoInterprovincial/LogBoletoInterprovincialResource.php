<?php

namespace App\Http\Resources\V2\LogBoletoInterprovincial;

use Illuminate\Http\Resources\Json\JsonResource;

class LogBoletoInterprovincialResource extends JsonResource
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
            'idCliente'            => $this->getIdCliente()->value(),
            'motivo'          => $this->getMotivo()->value(),
            'descripcion'          => $this->getDescripcion()->value(),
            'fecha'       => $this->getFecha()->value(),
        ];

    }
}
