<?php

namespace App\Http\Resources\Administracion\Personal;

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
            'apellido'       => $this->getApellido()->value(),
            'documentoIdentidad'       => $this->getDocumentoIdentidad()->value(),
            'fechaNacimiento'       => $this->getFechaNacimiento()->value(),
            'idCategoriaPersonal'       => $this->getIdCategoriaPersonal()->value(),
            'categoriaPersonal'       => $this->getCategoria()->value(),
            'idCliente'       => $this->getIdCliente()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioRegistro()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value(),
            'fechaRegistro'     => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idEstado'     => $this->getIdEstado()->value(),
        ];

    }
}
