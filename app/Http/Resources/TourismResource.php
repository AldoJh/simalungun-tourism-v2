<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourismResource extends JsonResource
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
            'category' => [
                'id' => $this->tourismCategory->id,
                'name' => $this->tourismCategory->name
            ],
            'image' => url('storage/'.$this->image),
            'metaDescription' => $this->excerpt,
            'description' => $this->description,
            'location' => [
                'district' => [
                    'id' => $this->district->id,
                    'name' => $this->district->name
                ],
                'village' => [
                    'id' => $this->village->id,
                    'name' => $this->village->name
                ],
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
                'address' => $this->address,
                'maps' => 'https://maps.google.com/?q='.$this->latitude.','.$this->longitude
            ],
            'images' => $this->tourismImage->map(function ($image) {
                return url('storage/'.$image->image);
            }),
            'facilities' => $this->tourismFacility->map(function ($facility) {
                return [
                    'id' => $facility->id,
                    'name' => $facility->facility->name
                ];
            }),
            'isRecomended' => $this->is_recomended ? true : false,
            'share' =>[
                'facebook' => 'https://www.facebook.com/sharer/sharer.php?u='.route('wisata.show', $this->slug),
                'linkedin' => 'http://www.linkedin.com/shareArticle?mini=true&url='.route('wisata.show', $this->slug),
                'whatsapp' => 'https://api.whatsapp.com/send?&text='.route('wisata.show', $this->slug)
            ]
        ];
    }
}
