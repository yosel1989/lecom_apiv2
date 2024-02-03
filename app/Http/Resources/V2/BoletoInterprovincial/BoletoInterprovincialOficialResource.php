<?php

namespace App\Http\Resources\V2\BoletoInterprovincial;

use Illuminate\Http\Resources\Json\JsonResource;

class BoletoInterprovincialOficialResource extends JsonResource
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
            'idCliente'            => $this->getIdCliente()->value(),
            'idSede'            => $this->getIdSede()->value(),
            'sede'            => $this->getSede()->value(),
            'idCaja'            => $this->getIdCaja()->value(),
            'caja'            => $this->getCaja()->value(),
            'idTipoDocumento'            => $this->getIdTipoDocumento()->value(),
            'tipoDocumento'            => $this->getTipoDocumento()->value(),
            'numeroDocumento'            => $this->getNumeroDocumento()->value(),
            'nombres'            => $this->getNombres()->value(),
            'apellidos'            => $this->getApellidos()->value(),
            'menorEdad'            => $this->getMenorEdad()->value(),
            'idVehiculo'            => $this->getIdVehiculo()->value(),
            'vehiculo'            => $this->getVehiculoPlaca()->value(),
            'idAsiento'            => $this->getIdAsiento()->value(),
            'fechaPartida'            => $this->getFechaPartida()->value(),
            'horaPartida'            => $this->getHoraPartida()->value(),
            'idRuta'            => $this->getIdRuta()->value(),
            'ruta'            => $this->getRuta()->value(),
            'idParaderoOrigen'            => $this->getIdParaderoOrigen()->value(),
            'paraderoOrigen'            => $this->getParaderoOrigen()->value(),
            'idParaderoDestino'            => $this->getIdParaderoDestino()->value(),
            'paraderoDestino'            => $this->getParaderoDestino()->value(),
            'precio'            => $this->getPrecio()->value(),
            'idTipoMoneda'            => $this->getIdTipoMoneda()->value(),
            'idFormaPago'            => $this->getIdFormaPago()->value(),
            'obsequio'            => $this->getObsequio()->value(),
            'idPos'            => $this->getIdPos()->value(),
            'codigo'            => $this->getCodigo()->value(),
            'latitud'            => $this->getLatitud()->value(),
            'longitud'            => $this->getLongitud()->value(),
            'fechaEmision'            => $this->getFechaEmision()->value(),
            'idEstado'            => $this->getIdEstado()->value(),
            'estado'            => $this->getEstado()->value(),
            'idUsuarioRegistro'            => $this->getIdUsuarioRegistro()->value(),
            'usuarioRegistro'            => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'            => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'            => $this->getUsuarioModifico()->value(),
            'fechaRegistro'            => $this->getFechaRegistro()->value(),
            'fechaModifico'            => $this->getFechaModifico()->value(),
            'idTipoComprobante'            => $this->getIdTipoComprobante()->value(),
            'idTipoBoleto'            => $this->getIdTipoBoleto()->value(),
            'porPagar'            => $this->getPorPagar()->value(),


            'tipoComprobante'            => $this->getTipoComprobante()->value(),
            'comprobanteSerie'            => $this->getComprobanteSerie()->value(),
            'comprobanteNumero'            => $this->getComprobanteNumero()->value(),

            'idOrigen'            => $this->getIdOrigen()->value(),
            'origen'            => $this->getOrigen()->value(),
            'idCajaDiario'            => $this->getIdCajaDiario()->value(),
            'idLiquidacion'            => $this->getIdLiquidacion()->value()
        ];

    }
}
