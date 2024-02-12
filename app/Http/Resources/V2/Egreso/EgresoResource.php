<?php

namespace App\Http\Resources\V2\Egreso;

use Illuminate\Http\Resources\Json\JsonResource;

class EgresoResource extends JsonResource
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
            'vehiculo'          => $this->getVehiculo()->value(),
            'personal'          => $this->getPersonal()->value(),
            'total'          => $this->getTotal()->value(),
            'idCaja'          => $this->getIdCaja()->value(),
            'caja'          => $this->getCaja()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'estado'       => $this->getEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioModifico()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value(),
            'comprobanteSerie'     => $this->getComprobanteSerie()->value(),
            'comprobanteNumero'     => $this->getComprobanteNumero()->value(),
            'tipoComprobante'     => $this->getTipoComprobante()->value(),
        ];

    }
}
