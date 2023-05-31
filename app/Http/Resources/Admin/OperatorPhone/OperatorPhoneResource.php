<?php

namespace App\Http\Resources\Admin\OperatorPhone;

use Illuminate\Http\Resources\Json\JsonResource;

class OperatorPhoneResource extends JsonResource
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
            'name' => $this->getName()->value()
        ];

    }
}
