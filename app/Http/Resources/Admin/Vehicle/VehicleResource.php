<?php

namespace App\Http\Resources\Admin\Vehicle;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
        $model = $this->getModel();
        $class = $this->getClass();
        $fleet = $this->getFleet();
        return [
            'id'                    => $this->getId()->value(),
            'plate'                  => $this->getPlate()->value(),
            'unit'                  => $this->getUnit()->value(),
            'deleted'              => $this->getDeleted()->value(),
            'id_client'             => $this->getIdClient()->value(),
            'id_category'            => $this->getIdCategory()->value(),
            'model'               => $model ? [
                'id' => $model->getId()->value(),
                'name' => $model->getName()->value()
            ] : null,
            'brand'               => $brand ? [
                'id' => $brand->getId()->value(),
                'name' => $brand->getName()->value()
            ] : null,
            'class'               => $class ? [
                'id' => $class->getId()->value(),
                'name' => $class->getName()->value()
            ] : null,
            'fleet'               => $fleet ? [
                'id' => $fleet->getId()->value(),
                'name' => $fleet->getName()->value()
            ] : null,
        ];
    }
}
