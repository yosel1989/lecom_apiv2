<?php

namespace App\Http\Resources\TransportePersonal\Paradero;

use Illuminate\Http\Resources\Json\JsonResource;

class ListHourByRouteResource extends JsonResource
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
            'idRuta'   => $this->getIdRuta()->value(),
            'idTipoRuta'   => $this->getIdTipoRuta()->value(),
            'idTipoParadero'   => $this->getIdTipoParadero()->value(),
            'hora'  => $this->getHora()->value(),
        ];

    }
}
