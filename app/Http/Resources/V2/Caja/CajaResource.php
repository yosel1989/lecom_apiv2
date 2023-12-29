<?php

namespace App\Http\Resources\V2\Caja;

use Illuminate\Http\Resources\Json\JsonResource;

class CajaResource extends JsonResource
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
            'nombre'          => $this->getNombre()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'idCliente'       => $this->getIdCliente()->value(),
            'idSede'       => $this->getIdSede()->value(),
            'idPos'       => $this->getIdPos()->value(),
            'pos'       => $this->getPos()->value(),
            'sede'       => $this->getSede()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioModifico()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value(),
            'aperturado'     => $this->getAperturado()->value(),
        ];

    }
}
