<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantMenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->type,
            'price' => $this->price,
            'image' => url('storage/'.$this->image),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
