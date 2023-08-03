<?php

namespace App\Http\Resources\V2\Usuario;

use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
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
            'usuario'          => $this->getUsuario()->value(),
            'nombre'          => $this->getNombre()->value(),
            'apellido'       => $this->getApellido()->value(),
            'perfil'       => $this->getPerfil()->value(),
            'correo'       => $this->getCorreo()->value(),
            'idPerfil'       => $this->getIdPerfil()->value(),
            'idSede'       => $this->getIdSede()->value(),
            'sede'       => $this->getSede()->value(),
            'idPersonal'       => $this->getIdPersonal()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioModifico()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value()
       ];

    }
}
