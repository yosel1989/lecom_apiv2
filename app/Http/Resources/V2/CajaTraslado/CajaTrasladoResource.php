<?php

namespace App\Http\Resources\V2\CajaTraslado;

use Illuminate\Http\Resources\Json\JsonResource;

class CajaTrasladoResource extends JsonResource
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
            'tipoComprobante'          => $this->getTipoComprobante()->value(),
            'serie'          => $this->getSerie()->value(),
            'numero'          => $this->getNumero()->value(),
            'idSede'          => $this->getIdSede()->value(),
            'sede'          => $this->getSede()->value(),
            'idCajaOrigen'          => $this->getIdCajaOrigen()->value(),
            'cajaOrigen'          => $this->getCajaOrigen()->value(),
            'idCajaDestino'          => $this->getIdCajaDestino()->value(),
            'cajaDestino'          => $this->getCajaDestino()->value(),
            'monto'          => $this->getMonto()->value(),
            'personal'          => $this->getPersonal()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'estado'       => $this->getEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioModifico()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value(),
        ];

    }
}
