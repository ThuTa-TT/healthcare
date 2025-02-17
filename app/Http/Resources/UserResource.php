<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'zip_code' => $this->zip_code,
            'address_one' => $this->address_one,
            'address_two' => $this->address_two,
            'phone_number' => $this->phone_number,
            'role_id' => $this->role->name,
        ];
    }
}
