<?php

namespace App\Http\Resources\V2\Paradero;

use Illuminate\Http\Resources\Json\JsonResource;

class ParaderoResource extends JsonResource
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
            'latitud'           => $this->getLatitud()->value(),
            'longitud'           => $this->getLongitud()->value(),
            'idTipoRuta'           => $this->getIdTipoRuta()->value(),
            'idRuta'           => $this->getIdRuta()->value(),
            'idCliente'           => $this->getIdCliente()->value(),
            'idUsuarioRegistro'   => $this->getIdUsuarioRegistro()->value(),
            'idUsuarioModifico'   => $this->getIdUsuarioModifico()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'       => $this->getFechaModifico()->value(),

            'tipoRuta'   => $this->getTipoRuta()->value(),
            'ruta'   => $this->getRuta()->value(),
            'usuarioRegistro'   => $this->getUsuarioRegistro()->value(),
            'usuarioModifico'   => $this->getUsuarioModifico()->value(),
        ];
    }
}
