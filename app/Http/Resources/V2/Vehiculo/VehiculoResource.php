<?php

namespace App\Http\Resources\V2\Vehiculo;

use Illuminate\Http\Resources\Json\JsonResource;

class VehiculoResource extends JsonResource
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
            'placa'          => $this->getPlaca()->value(),
            'unidad'       => $this->getUnidad()->value(),
            'idCliente'       => $this->getIdCliente()->value(),
            'idMarca'       => $this->getIdMarca()->value(),
            'idCategoria'       => $this->getIdCategoria()->value(),
            'idModelo'       => $this->getIdModelo()->value(),
            'idClase'       => $this->getIdClase()->value(),
            'idFlota'       => $this->getIdFlota()->value(),
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
