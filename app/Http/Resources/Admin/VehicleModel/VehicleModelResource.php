<?php

namespace App\Http\Resources\Admin\VehicleModel;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleModelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $brand = $this->getBrand();
        // Map Domain User model values
        return [
            'id'    => $this->getId()->value(),
            'name'  => $this->getName()->value(),
            'brand' => $brand ? [
                'id'    => $brand->getId()->value(),
                'name'  => $brand->getName()->value()
            ] : $brand
        ];

    }
}
