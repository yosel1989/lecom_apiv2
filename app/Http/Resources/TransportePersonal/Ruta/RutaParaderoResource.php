<?php

namespace App\Http\Resources\TransportePersonal\Ruta;

use Illuminate\Http\Resources\Json\JsonResource;

class RutaParaderoResource extends JsonResource
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
            'idTipoRuta'  => $this->getIdTipoRuta()->value(),
            'tipoRuta'  => $this->getTipoRuta()->value(),
            'idParadero'  => $this->getIdParadero()->value(),
            'paradero'      => $this->getParadero()->value(),
            'idTipo'   => $this->getIdTipo()->value(),
        ];

    }
}
