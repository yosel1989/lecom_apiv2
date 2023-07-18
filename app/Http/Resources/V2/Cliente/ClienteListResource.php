<?php

namespace App\Http\Resources\V2\Cliente;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteListResource extends JsonResource
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
            'idTipoDocumento'       => $this->getIdTipoDocumento()->value(),
            'tipoDocumento'       => $this->getTipoDocumento()->value(),
            'numeroDocumento'       => $this->getNumeroDocumento()->value(),
            'nombre'       => $this->getNombre()->value(),
            'nombreContacto'       => $this->getNombreContacto()->value(),
            'correo'       => $this->getCorreo()->value(),
            'direccion'       => $this->getDireccion()->value(),
            'telefono1'       => $this->getTelefono1()->value(),
            'telefono2'       => $this->getTelefono2()->value(),
            'idTipo'       => $this->getIdTipo()->value(),
            'idCliente'       => $this->getIdCliente()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),
            'idUsuarioRegistro'       => $this->getIdUsuarioRegistro()->value(),
            'usuarioRegistro'       => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'       => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'       => $this->getUsuarioModifico()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'       => $this->getFechaModifico()->value(),

        ];

    }
}
