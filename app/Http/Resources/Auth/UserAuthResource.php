<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthResource extends JsonResource
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
            'username'      => $this->getUsername()->value(),
            'first_name'    => $this->getFirstName()->value(),
            'last_name'     => $this->getLastName()->value(),
            'email'         => $this->getEmail()->value(),
            'actived'       => $this->getActived()->value() ? true : false,
            'deleted'       => $this->getDeleted()->value() ? true : false ,
            'id_client'     => $this->getIdClient()->value(),
        ];

    }
}
