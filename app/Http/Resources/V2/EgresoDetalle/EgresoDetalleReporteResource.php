<?php

namespace App\Http\Resources\V2\EgresoDetalle;

use Illuminate\Http\Resources\Json\JsonResource;

class EgresoDetalleReporteResource extends JsonResource
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
            'detalle'          => $this->getDetalle()->value(),
            'tipo'          => $this->getEgresoTipo()->value(),
            'fecha'          => $this->getFecha()->value() . ' 00:00:00',
            'importe'          => $this->getImporte()->value(),
            'numeroDocumento'          => $this->getNumeroDocumento()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioModifico()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value(),
            'codigo'     => $this->getCodigo()->value(),
            'vehiculo'     => $this->getVehiculo()->value(),
            'personal'     => $this->getPersonal()->value(),
        ];

    }
}
