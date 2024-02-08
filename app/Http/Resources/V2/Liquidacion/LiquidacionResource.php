<?php

namespace App\Http\Resources\V2\Liquidacion;

use Illuminate\Http\Resources\Json\JsonResource;

class LiquidacionResource extends JsonResource
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
            'codigo'          => $this->getCodigo()->value(),
            'idCliente'          => $this->getIdCliente()->value(),
            'idSede'          => $this->getIdSede()->value(),
            'idVehiculos'          => $this->getIdVehiculos(),
            'idPersonal'          => $this->getIdSede()->value(),
            'archivo'          => $this->getArchivo()->value(),
            'urlArchivo'          => asset($this->getUrlArchivo()->value()),
            'fechaInicio'          => $this->getFechaDesde()->value() . 'T00:00:00',
            'fechaFinal'          => $this->getFechaHasta()->value() . 'T00:00:00',
            'idEstado'       => $this->getIdEstado()->value(),
            'estado'       => $this->getEstado()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioRegistro()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value(),
            'local'     => $this->getLocal()->value(),
            'monto'     => $this->getMonto()->value(),
        ];

    }
}
