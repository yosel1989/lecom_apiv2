<?php

namespace App\Http\Resources\V2\LiquidacionMotivo;

use Illuminate\Http\Resources\Json\JsonResource;

class LiquidacionMotivoResource extends JsonResource
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
            'idEstado'          => $this->getIdEstado()->value(),
        ];

    }
}
