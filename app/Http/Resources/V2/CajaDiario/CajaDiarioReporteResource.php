<?php

namespace App\Http\Resources\V2\CajaDiario;

use Illuminate\Http\Resources\Json\JsonResource;

class CajaDiarioReporteResource extends JsonResource
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
            'idCaja'          => $this->getIdCaja()->value(),
            'caja'       => $this->getCaja()->value(),
            'idUsuarioAperturo'       => $this->getIdUsuarioAperturo()->value(),
            'usuarioAperturo'       => $this->getUsuarioAperturo()->value(),
            'fechaApertura'       => $this->getFechaApertura()->value(),
            'saldoInicial'       => $this->getSaldoInicial()->value(),
            'idUsuarioCerro'       => $this->getIdUsuarioCerro()->value(),
            'usuarioCerro'       => $this->getUsuarioCerro()->value(),
            'fechaCierre'       => $this->getFechaCierre()->value(),
            'saldoFinal'       => $this->getSaldoFinal()->value(),
            'estado'       => $this->getEstado()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
        ];

    }
}
