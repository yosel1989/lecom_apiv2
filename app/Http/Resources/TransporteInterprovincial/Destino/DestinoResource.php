<?php

namespace App\Http\Resources\TransporteInterprovincial\Destino;

use Illuminate\Http\Resources\Json\JsonResource;

class DestinoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                  => $this->getId()->value(),
            'nombre'              => $this->getNombre()->value(),
            'precioBase'          => $this->getPrecioBase()->value(),
            'idEstado'            => $this->getIdEstado()->value(),
            'idCliente'           => $this->geIdCliente()->value(),
            'idUsuarioRegistro'   => $this->getIdUsuarioRegistro()->value(),
            'idUsuarioModifico'   => $this->getIdUsuarioModifico()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'       => $this->getFechaModifico()->value()
        ];
    }
}
