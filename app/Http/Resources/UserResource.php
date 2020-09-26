<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->name,
            'email' => $this->email,
            'notes' => $this->notes,
            'date_of_birth' => $this->date_of_birth,
            'last_login_at' => $this->last_login_at,
            'status' => [
                'id' => $this->status,
                'name' => $this->statusName
            ],
            'roles' => new RoleResource($this->roles->first())
        ];
    }
}
