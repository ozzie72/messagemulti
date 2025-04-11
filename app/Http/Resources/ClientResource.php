<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'company' => $this->company,
            'contact_name' => $this->name . ' ' . $this->last_name,
            'server_info' => [
                'ip' => $this->ip,
                'port' => $this->port,
            ],
            'status' => (bool) $this->status,
            'image' => $this->image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'organization' => [
                'divition' => $this->whenLoaded('divition', function () {
                    return $this->divition->name;
                }),
                'department' => $this->whenLoaded('department', function () {
                    return $this->department->name;
                }),
            ],
            'location' => [
                'country' => $this->whenLoaded('country', function () {
                    return $this->country->name;
                }),
                'state' => $this->whenLoaded('state', function () {
                    return $this->state->name;
                }),
                'city' => $this->whenLoaded('city', function () {
                    return $this->city->name;
                }),
            ],
            'stats' => [
                'users_count' => $this->whenLoaded('users', function () {
                    return $this->users->count();
                }),
                'campaigns_count' => $this->whenLoaded('campaigns', function () {
                    return $this->campaigns->count();
                }),
            ],
        ];
    }
}