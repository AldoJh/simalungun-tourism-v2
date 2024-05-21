<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'slug' => $this->slug,
            'name' => $this->name,
            'date' => $this->date,
            'price' => $this->price,
            'image' => url('storage/'.$this->image),
            'description' => $this->description,
            'location' => [
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
                'address' => $this->address,
                'maps' => 'https://maps.google.com/?q='.$this->latitude.','.$this->longitude
            ],
            'images' => $this->eventImage->map(function ($image) {
                return url('storage/'.$image->image);
            }),
            'attribute' => $this->eventAttribute->map(function ($atribut) {
                return [
                    'id' => $atribut->id,
                    'name' => $atribut->name,
                    'value' => $atribut->value,
                    'image' => url('storage/'.$atribut->image)
                ];
            }),
            'share' =>[
                'facebook' => 'https://www.facebook.com/sharer/sharer.php?u='.route('festival.show', $this->slug),
                'linkedin' => 'http://www.linkedin.com/shareArticle?mini=true&url='.route('festival.show', $this->slug),
                'whatsapp' => 'https://api.whatsapp.com/send?&text='.route('festival.show', $this->slug)
            ],
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
