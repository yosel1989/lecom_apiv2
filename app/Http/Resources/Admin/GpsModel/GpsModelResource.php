<?php

namespace App\Http\Resources\Admin\GpsModel;

use Illuminate\Http\Resources\Json\JsonResource;

class GpsModelResource extends JsonResource
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
            'id'   => $this->getId()->value(),
            'name' => $this->getName()->value(),
            'input' => $this->getInput()->value(),
            'output' => $this->getOutput()->value()
        ];

    }
}
