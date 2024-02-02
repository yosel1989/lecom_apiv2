<?php

namespace App\Http\Resources\V2\BoletoPrecio;

use Illuminate\Http\Resources\Json\JsonResource;

class BoletoPrecioResource extends JsonResource
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
            'idCliente'              => $this->getIdCliente()->value(),
            'idTipoRuta'           => $this->getIdTipoRuta()->value(),
            'idRuta'           => $this->getIdRuta()->value(),
            'idParaderoOrigen'           => $this->getIdParaderoOrigen()->value(),
            'paraderoOrigen'           => $this->getParaderoOrigen()->value(),
            'idParaderoDestino'           => $this->getIdParaderoDestino()->value(),
            'paraderoDestino'           => $this->getParaderoDestino()->value(),
            'precioBase'          => $this->getPrecioBase()->value(),
            'idEstado'            => $this->getIdEstado()->value(),
            'predeterminado'            => $this->getPredeterminado()->value(),
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
