<?php

namespace App\Http\Resources\V2\BoletoInterprovincial;

use Illuminate\Http\Resources\Json\JsonResource;

class BoletoInterprovincialResource extends JsonResource
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
            'idCliente'          => $this->getIdCliente()->value(),
            'idVehiculo'       => $this->getIdVehiculo()->value(),
            'idDestino'       => $this->getIdDestino()->value(),
            'numeroDocumento'       => $this->getNumeroDocumento()->value(),
            'codigoBoleto'       => $this->getCodigoBoleto()->value(),
            'latitud'       => $this->getLatitud()->value(),
            'longitud'       => $this->getLongitud()->value(),
            'precio'       => $this->getPrecio()->value(),
            'fecha'       => $this->getFecha()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioModifico()->value(),
            //'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            //'usuarioModifico'     => $this->getUsuarioModifico()->value(),
        ];

    }
}
