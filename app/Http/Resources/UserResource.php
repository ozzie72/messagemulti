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
            'last_name' => $this->last_name,
            'full_name' => $this->name . ' ' . $this->last_name,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'initials' => $this->initials(),
            'status' => $this->user_status,
            'confirmed' => (bool) $this->confirmed,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'roles' => $this->whenLoaded('roles', function () {
                return $this->roles->pluck('name');
            }),
            'client' => $this->whenLoaded('client', function () {
                return [
                    'id' => $this->client->id,
                    'company' => $this->client->company,
                ];
            }),
            'location' => [
                'country' => $this->country_id ? $this->country->name : null,
                'state' => $this->state_id ? $this->state->name : null,
                'city' => $this->city_id ? $this->city->name : null,
            ],
        ];
    }
}