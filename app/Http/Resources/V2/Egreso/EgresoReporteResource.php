<?php

namespace App\Http\Resources\V2\Egreso;

use Illuminate\Http\Resources\Json\JsonResource;

class EgresoReporteResource extends JsonResource
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
            'vehiculo'          => $this->getVehiculo()->value(),
            'idPersonal'          => $this->getIdPersonal()->value(),
            'personal'          => $this->getPersonal()->value(),
            'total'          => $this->getTotal()->value(),
            'idCaja'          => $this->getIdCaja()->value(),
            'caja'          => $this->getCaja()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
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
