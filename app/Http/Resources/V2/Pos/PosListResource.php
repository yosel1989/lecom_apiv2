<?php

namespace App\Http\Resources\V2\Pos;

use Illuminate\Http\Resources\Json\JsonResource;

class PosListResource extends JsonResource
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
            'imei'          => $this->getImei()->value(),
            'idSede'          => $this->getIdSede()->value(),
//            'idCliente'          => $this->getIdCliente()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),

        ];

    }
}
