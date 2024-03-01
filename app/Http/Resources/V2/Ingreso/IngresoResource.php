<?php

namespace App\Http\Resources\V2\Ingreso;

use Illuminate\Http\Resources\Json\JsonResource;

class IngresoResource extends JsonResource
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
            'codigo'          => $this->getSerie()->value() . '-' . str_pad($this->getNumero()->value(), 8, '0', STR_PAD_LEFT),
            'tipoIngreso'          => $this->getTipoIngreso()->value(),
            'detalle'          => $this->getDetalle()->value(),
            'importe'          => $this->getImporte()->value(),
            'medioPago'          => $this->getMedioPago()->value(),
            'entidadFinanciera'          => $this->getEntidadFinanciera()->value(),
            'numeroOperacion'          => $this->getNumeroOperacion()->value(),
            'idCaja'          => $this->getIdCaja()->value(),
            'caja'          => $this->getCaja()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'estado'       => $this->getEstado()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioModifico()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value(),
            'tipoDocumentoEntidad'     => $this->getTipoDocumentoEntidad()->value(),
            'numeroDocumentoEntidad'     => $this->getNumeroDocumentoEntidad()->value(),
            'nombreEntidad'     => $this->getNombreEntidad()->value(),
        ];

    }
}
