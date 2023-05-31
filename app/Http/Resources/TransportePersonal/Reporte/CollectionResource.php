<?php

namespace App\Http\Resources\TransportePersonal\Reporte;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
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
            'matricula'          => $this->getMatricula()->value(),
            'idTipoRuta'       => $this->getIdTipoRuta()->value(),
            'tipoRuta'      => $this->getTipoRuta()->value(),
            'idParaderoAbordaje'     => $this->getIdParaderoAbordaje()->value(),
            'paraderoAbordaje'     => $this->getParaderoAbordaje()->value(),
            'idParaderoDestino'     => $this->getIdParaderoDestino()->value(),
            'paraderoDestino'     => $this->getParaderoDestino()->value(),
            'fechaRegistro'     => $this->getFecha()->value(),
        ];

    }
}
