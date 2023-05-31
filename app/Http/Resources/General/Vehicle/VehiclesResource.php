<?php

namespace App\Http\Resources\General\Vehicle;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VehiclesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => VehiclesResourceForSelect::collection($this->collection)
        ];
    }
}
