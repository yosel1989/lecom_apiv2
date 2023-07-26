<?php

namespace App\Http\Resources\V2\TipoSerie;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoSerieResource extends JsonResource
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
        ];

    }
}
