<?php

namespace App\Http\Resources\TransportePersonal\Paradero;

use Illuminate\Http\Resources\Json\JsonResource;

class ListHourResource extends JsonResource
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
            'ruta'   => $this->getRuta()->value(),
            'idTipoRuta'   => $this->getIdTipoRuta()->value(),
            'tipoRuta'   => $this->getTipoRuta()->value(),
            'idTipoParadero'   => $this->getIdTipoParadero()->value(),
            'hora'  => $this->getHora()->value(),
        ];

    }
}
