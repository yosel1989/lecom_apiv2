<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Admin\Module\ModuleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $modules = $this->getModules();
        // Map Domain User model values
        return [
            'id'            => $this->getId()->value(),
            'username'      => $this->getUsername()->value(),
            'firstName'    => $this->getFirstName()->value(),
            'lastName'     => $this->getLastName()->value(),
            'email'         => $this->getEmail()->value(),
            'phone'         => $this->getPhone()->value(),
            'level'         => $this->getLevel()->value(),
            'actived'       => !!$this->getActived()->value(),
            'deleted'       => $this->getDeleted()->value(),
            'id_client'     => $this->getIdClient()->value(),
            'id_role'       => $this->getIdRole()->value(),
            'modules'       => ModuleResource::collection($modules)
        ];

    }
}
