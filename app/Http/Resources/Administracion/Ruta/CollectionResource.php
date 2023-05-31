<?php

namespace App\Http\Resources\Administracion\Ruta;

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
            'nombre'          => $this->getNombre()->value(),
            'codigo'          => $this->getCodigo()->value(),
            'idCliente'      => $this->getIdCliente()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioRegistro()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value(),
            //'userCreated'     => !is_null($userCreated) ? ($userCreated->getFirstName()->value() . ' ' . $userCreated->getLastName()->value()) : null,
            //'userUpdated'     => !is_null($userUpdated) ? ($userUpdated->getFirstName()->value() . ' ' . $userUpdated->getLastName()->value()) : null,
            'fechaRegistro'     => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idEstado'     => $this->getIdEstado()->value(),
        ];

    }
}
