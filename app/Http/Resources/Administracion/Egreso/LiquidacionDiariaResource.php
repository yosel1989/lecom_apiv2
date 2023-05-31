<?php

namespace App\Http\Resources\Administracion\Egreso;

use Illuminate\Http\Resources\Json\JsonResource;

class LiquidacionDiariaResource extends JsonResource
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
            'idTipoEgreso'            => $this->getIdTipoEgreso()->value(),
            'tipoEgreso'          => $this->getTipoEgreso()->value(),
            'total'       => $this->getTotal()->value()
        ];

    }
}
