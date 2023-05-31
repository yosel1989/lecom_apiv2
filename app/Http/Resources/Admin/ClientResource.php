<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'bussinessName' => $this->getBussinessName()->value(),
            'firstName'    => $this->getFirstName()->value(),
            'lastName'     => $this->getLastName()->value(),
            'ruc'     => $this->getRuc()->value(),
            'dni'     => $this->getDni()->value(),
            'email'         => $this->getEmail()->value(),
            'address'         => $this->getAddress()->value(),
            'phone'         => $this->getPhone()->value(),
            'type'       => $this->getType()->value(),
            'idParent'     => $this->getIdParent()->value()
        ];

    }
}
