<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'label' => $this->label ? 'Halal' : 'Non-Halal',
            'owner' => $this->owner,
            'phone' => $this->phone,
            'tableCount' => $this->table,
            'chairCount' => $this->chair,
            'rating' => [
                'rate' => round($this->restaurantReview->average('rating'), 1),
                'count' => count($this->restaurantReview)
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
            'images' => $this->restaurantImage->map(function ($image) {
                return url('storage/'.$image->image);
            }),
            'facilities' => $this->restaurantFacility->map(function ($facility) {
                return [
                    'id' => $facility->id,
                    'name' => $facility->facility->name
                ];
            }),
            'isRecomended' => $this->is_recomended ? true : false,
            'share' =>[
                'facebook' => 'https://www.facebook.com/sharer/sharer.php?u='.route('restoran.show', $this->slug),
                'linkedin' => 'http://www.linkedin.com/shareArticle?mini=true&url='.route('restoran.show', $this->slug),
                'whatsapp' => 'https://api.whatsapp.com/send?&text='.route('restoran.show', $this->slug)
            ],
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
