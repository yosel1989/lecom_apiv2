<?php

namespace App\Http\Resources\V2\CronogramaSalida;

use Illuminate\Http\Resources\Json\JsonResource;

class CronogramaSalidaResource extends JsonResource
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
            'idCronograma'          => $this->getIdCronograma()->value(),
            'idVehiculo'          => $this->getIdVehiculo()->value(),
            'vehiculo'          => $this->getVehiculo()->value(),
            'fecha'          => $this->getFecha()->value(),
            'hora'          => $this->getHora()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'estado'       => $this->getIdEstado()->value() ? 'Activo' : 'Inactivo',
            'idEliminado'       => $this->getIdEliminado()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioModifico()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value()
        ];

    }
}
