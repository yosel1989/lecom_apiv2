<?php

namespace App\Http\Resources\V2\BoletoInterprovincial;

use Illuminate\Http\Resources\Json\JsonResource;

class BoletoInterprovincialResource extends JsonResource
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
            'idRuta'       => $this->getIdRuta()->value(),
            'idParaderoOrigen'       => $this->getIdParaderoOrigen()->value(),
            'idParaderoDestino'       => $this->getIdParaderoDestino()->value(),
            'idVehiculo'       => $this->getIdVehiculo()->value(),
            'idCaja'       => $this->getIdCaja()->value(),
            'idPos'       => $this->getIdPos()->value(),
            'idCliente'          => $this->getIdCliente()->value(),
            'tipoDocumento'          => $this->getTipoDocumento()->value(),
            'idTipoDocumento'          => $this->getIdTipoDocumento()->value(),
            'numeroDocumento'       => $this->getNumeroDocumento()->value(),
            'nombre'       => $this->getNombre()->value(),
            'direccion'       => $this->getDireccion()->value(),
            'serie'       => $this->getSerie()->value(),
            'numeroBoleto'       => $this->getNumeroBoleto()->value(),
            'codigoBoleto'       => $this->getCodigoBoleto()->value(),
            'latitud'       => $this->getLatitud()->value(),
            'longitud'       => $this->getLongitud()->value(),
            'precio'       => $this->getPrecio()->value(),
            'fecha'       => $this->getFecha()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),
            'enBlanco'       => $this->getEnBlanco()->value(),
            'fechaRegistro'       => $this->getFechaRegistro()->value(),
            'fechaModifico'     => $this->getFechaModifico()->value(),
            'idUsuarioRegistro'     => $this->getIdUsuarioRegistro()->value(),
            'usuarioRegistro'     => $this->getUsuarioRegistro()->value(),
            'idUsuarioModifico'     => $this->getIdUsuarioModifico()->value(),
            'usuarioModifico'     => $this->getUsuarioModifico()->value(),


            'ruta'     => $this->getRuta()->value(),
            'paradero'     => $this->getParadero()->value(),
            'vehiculo'     => $this->getVehiculo()->value(),
        ];

    }
}
