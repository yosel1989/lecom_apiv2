<?php

namespace App\Http\Resources\TransporteInterprovincial\Destino;

use Illuminate\Http\Resources\Json\JsonResource;

class ShortDestinoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id'                    => $this->getId()->value(),
            'plate'                  => $this->getPlate()->value(),
            'unit'                  => $this->getUnit()->value()
        ];
    }
}
