<?php

namespace App\Http\Resources\V2\Cronograma;

use Illuminate\Http\Resources\Json\JsonResource;

class CronogramaResource extends JsonResource
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
            'idSede'          => $this->getIdSede()->value(),
            'sede'          => $this->getSede()->value(),
            'idTipoRuta'          => $this->getIdTipoRuta()->value(),
            'tipoRuta'          => $this->getTipoRuta()->value(),
            'idRuta'          => $this->getIdRuta()->value(),
            'ruta'          => $this->getRuta()->value(),
            'fecha'          => $this->getFecha()->value(),
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
