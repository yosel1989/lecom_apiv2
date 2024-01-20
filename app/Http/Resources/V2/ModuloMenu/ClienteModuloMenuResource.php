<?php

namespace App\Http\Resources\V2\ModuloMenu;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteModuloMenuResource extends JsonResource
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
            'texto'          => $this->getTexto()->value(),
            'icono'          => $this->getIcono()->value(),
            'idTipoMenu'       => $this->getIdTipoMenu()->value(),
            'tipoMenu'       => $this->getTipoMenu()->value(),
            'padre'       => $this->getPadre()->value(),
            'link'       => $this->getLink()->value(),
            'idModulo'       => $this->getIdModulo()->value(),
            'modulo'       => $this->getModulo()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioModifico()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value(),
            'hijos'     => ClienteModuloMenuResource::collection($this->getHijos()),
            'activado'     => $this->getActivado()->value(),
        ];

    }
}
