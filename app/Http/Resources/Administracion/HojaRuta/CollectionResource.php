<?php

namespace App\Http\Resources\Administracion\HojaRuta;

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
            'idVehiculo'          => $this->getIdVehiculo()->value(),
            'idPersonal'       => $this->getIdPersonal()->value(),
            'idRuta'       => $this->getIdRuta()->value(),
            'fechaAsignada'       => $this->getFechaAsignada()->value(),
            'horaAsignada'       => $this->getHoraAsignada()->value(),
            'urlHojaRuta'       => $this->getUrlHojaRuta()->value(),
            'idCliente'       => $this->getIdCliente()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioRegistro()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value(),
            'fechaRegistro'     => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idEstado'     => $this->getIdEstado()->value(),

            'placa'          => $this->getPlaca()->value(),
            'ruta'          => $this->getRuta()->value(),
            'personal'          => $this->getPersonal()->value(),
        ];

    }
}
