<?php

namespace App\Http\Resources\Administracion\Ingreso;

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
            'fecha'          => $this->getFecha()->value(),
            'idTipoIngreso'       => $this->getIdTipoIngreso()->value(),
            'tipoIngreso'       => $this->getTipoIngreso()->value(),
            'idVehiculo'       => $this->getIdVehiculo()->value(),
            'vehiculo'       => $this->getVehiculo()->value(),
            'idPersonal'       => $this->getIdPersonal()->value(),
            'personal'       => $this->getPersonal()->value(),
            'idRuta'       => $this->getIdRuta()->value(),
            'ruta'       => $this->getRuta()->value(),
            'monto'       => $this->getMonto()->value(),
            'idCliente'       => $this->getIdCliente()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioRegistro()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value(),
            'fechaRegistro'     => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idEstado'     => $this->getIdEstado()->value(),
        ];

    }
}
