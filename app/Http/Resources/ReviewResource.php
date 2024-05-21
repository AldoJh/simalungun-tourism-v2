<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->user->photo){
            $image = url('storage/'.$this->user->photo);
        }else{
            $image = ' https://ui-avatars.com/api/?background=E79024&color=fff&name='.$this->user->name;
        }
        return[
            'id' => $this->id,
            'rate' => $this->rating,
            'comment' => $this->comment,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'image' => $image
            ]
        ];
    }
}
