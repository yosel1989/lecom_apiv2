<?php

namespace App\Http\Resources\Admin\SimCard;

use Illuminate\Http\Resources\Json\JsonResource;

class SimCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $operator = $this->getOperator();
        $client = $this->getClient();
        // Map Domain User model values
        return [
            'id'    => $this->getId()->value(),
            'number'  => $this->getNumber()->value(),
            'imei'  => $this->getImei()->value(),
            'detail' => $this->getDetail()->value(),
            'status' => $this->getStatus()->value() ? true : false,
            'operator' => $operator ? [
                'id'    => $operator->getId()->value(),
                'name'  => $operator->getName()->value()
            ] : $operator,
            'client' => $client ? [
                'id'    => $client->getId()->value(),
                'name'  => $client->getBussinessName()->value()
            ] : $client
        ];

    }
}
