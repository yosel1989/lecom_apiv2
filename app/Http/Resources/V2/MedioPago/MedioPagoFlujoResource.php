<?php

namespace App\Http\Resources\V2\MedioPago;

use Illuminate\Http\Resources\Json\JsonResource;

class MedioPagoFlujoResource extends JsonResource
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
            'ingresos'            => MedioPagoCajaDiarioResource::collection($this->getIngresos()->all()),
            'egresos'          => MedioPagoCajaDiarioResource::collection($this->getEgresos()->all()),
        ];

    }
}
