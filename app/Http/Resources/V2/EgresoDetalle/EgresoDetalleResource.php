<?php

namespace App\Http\Resources\V2\EgresoDetalle;

use Illuminate\Http\Resources\Json\JsonResource;

class EgresoDetalleResource extends JsonResource
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
            'idEgreso'            => $this->getIdEgreso()->value(),
            'idCliente'          => $this->getIdCliente()->value(),
            'idTipo'          => $this->getIdEgresoTipo()->value(),
            'tipo'          => $this->getEgresoTipo()->value(),
            'fecha'          => $this->getFecha()->value(),
            'importe'          => $this->getImporte()->value(),
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
