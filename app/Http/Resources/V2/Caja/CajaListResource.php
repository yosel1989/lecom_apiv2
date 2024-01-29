<?php

namespace App\Http\Resources\V2\Caja;

use Illuminate\Http\Resources\Json\JsonResource;

class CajaListResource extends JsonResource
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
            'idSede'          => $this->getIdSede()->value(),
//            'pos'          => $this->getPos()->value(),
            'idPos'          => $this->getIdPos()->value(),
            'idEstado'       => $this->getIdEstado()->value(),
            'idEliminado'       => $this->getIdEliminado()->value(),

        ];

    }
}
