<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
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
            'owner' => $this->owner,
            'phone' => $this->phone,
            'roomCount' => $this->room,
            'price' => [
                'min' => $this->min_price,
                'max' => $this->max_price,
            ],
            'rating' => [
                'rate' => round($this->hotelReview->average('rating'), 1),
                'count' => count($this->hotelReview)
            ],
            'category' => [
                'id' => $this->hotelCategory->id,
                'name' => $this->hotelCategory->name
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
            'images' => $this->hotelImage->map(function ($image) {
                return url('storage/'.$image->image);
            }),
            'facilities' => $this->hotelFacility->map(function ($facility) {
                return [
                    'id' => $facility->id,
                    'name' => $facility->facility->name
                ];
            }),
            'isVerified' => $this->is_verified ? true : false,
            'share' =>[
                'facebook' => 'https://www.facebook.com/sharer/sharer.php?u='.route('hotel.show', $this->slug),
                'linkedin' => 'http://www.linkedin.com/shareArticle?mini=true&url='.route('hotel.show', $this->slug),
                'whatsapp' => 'https://api.whatsapp.com/send?&text='.route('hotel.show', $this->slug)
            ],
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
