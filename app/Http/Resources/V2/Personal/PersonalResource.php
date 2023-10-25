<?php

namespace App\Http\Resources\V2\Personal;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        $image = file_get_contents($this->getFoto()->value());
//        $urlImage = '';
//        if ($image !== false){
//            $urlImage = 'data:image/jpg;base64,'.base64_encode($image);
//        }


        // Map Domain User model values
        return [
            'id'            => $this->getId()->value(),
            'foto'          => $this->getFoto()->value(),
            'fotoBase64'    =>  $this->getFotoBase64()->value(),
            'nombre'          => $this->getNombre()->value(),
            'apellido'       => $this->getApellido()->value(),
            'idCliente'       => $this->getIdCliente()->value(),
            'idSede'       => $this->getIdSede()->value(),
            'sede'       => $this->getSede()->value(),
            'correo'       => $this->getCorreo()->value(),
            'idTipoDocumento'       => $this->getIdTipoDocumento()->value(),
            'tipoDocumento'       => $this->getTipoDocumento()->value(),
            'numeroDocumento'       => $this->getNumeroDocumento()->value(),
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
