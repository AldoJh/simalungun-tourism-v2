<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        if($this->user->photo){
            $image = url('storage/'.$this->user->photo);
        }else{
            $image = ' https://ui-avatars.com/api/?background=E79024&color=fff&name='.$this->user->name;
        }

        return[
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'date' => $this->date,
            'description' => $this->description,
            'content' => $this->content,
            'image' => url('storage/'.$this->image),
            'images' => $this->newsImage->map(function ($image) {
                return url('storage/'.$image->image);
            }),
            'author' => [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'image' => $image
            ],
            'share' =>[
                'facebook' => 'https://www.facebook.com/sharer/sharer.php?u='.route('berita.show', $this->slug),
                'linkedin' => 'http://www.linkedin.com/shareArticle?mini=true&url='.route('berita.show', $this->slug),
                'whatsapp' => 'https://api.whatsapp.com/send?&text='.route('berita.show', $this->slug)
            ],
            'comment' => $this->comment->map(function ($comment) {
                if($comment->user->photo){
                    $commentImage = url('storage/'.$comment->user->photo);
                }else{
                    $commentImage = ' https://ui-avatars.com/api/?background=E79024&color=fff&name='.$comment->user->name;
                }
                $commentData = [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'user' => [
                        'id' => $comment->user->id,
                        'name' => $comment->user->name,
                        'image' => $commentImage
                    ]
                ];
                return $commentData;
            }),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
