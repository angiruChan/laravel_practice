<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'users',
            'id' => $this->id,
            'attributes' => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'birthdate' => $this->birthdate_format,
                'address' => $this->address,
            ],
            'relationships'  => [],
            'links' => [
                'self' =>  route('users.show', $this->id)
            ]
        ];
    }
}
