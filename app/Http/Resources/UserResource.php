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
            'is_admin' => $this->is_admin,
            'relation' => $this->relation,
            'subscriptionToken' => $this->subscriptionToken,
            'accessLevel' => $this->accessLevel,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'code' => $this->code,
            'password' => $this->password,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
