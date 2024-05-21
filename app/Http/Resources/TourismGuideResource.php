<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourismGuideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'image' => url('storage/'.$this->image),
            'gender' => $this->gender,
            'religion' => $this->religion,
            'country' => $this->country,
            'birthdate' => $this->birthdate,
            'phone' => $this->phone,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
