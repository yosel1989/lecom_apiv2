<?php

namespace App\Http\Resources\V2\ComprobanteSerie;

use Illuminate\Http\Resources\Json\JsonResource;

class ComprobanteSerieResource extends JsonResource
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
            'idTipoComprobante'       => $this->getIdTipoComprobante()->value(),
            'tipoComprobante'       => $this->getTipoComprobante()->value(),
            'idEmpresa'       => $this->getIdEmpresa()->value(),
            'empresa'       => $this->getEmpresa()->value(),
            'idSede'       => $this->getIdSede()->value(),
            'sede'       => $this->getSede()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioModifico()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value(),
        ];

    }
}
