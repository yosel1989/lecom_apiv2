<?php

namespace App\Http\Resources\V2\ClienteMedioPago;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteMedioPagoFlujoResource extends JsonResource
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
            'ingresos'            => ClienteMedioPagoCajaDiarioResource::collection($this->getIngresos()->all()),
            'egresos'          => ClienteMedioPagoCajaDiarioResource::collection($this->getEgresos()->all()),
        ];

    }
}
