<?php

namespace App\Http\Resources\TransportePersonal\TipoRuta;

use Illuminate\Http\Resources\Json\JsonResource;

class ListResource extends JsonResource
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
            'idParadero'  => $this->getIdParadero()->value(),
            'paradero'      => $this->getParadero()->value(),
            'idTipo'   => $this->getIdTipo()->value(),
        ];

    }
}
