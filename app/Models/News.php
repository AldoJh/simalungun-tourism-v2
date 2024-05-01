<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\NewsImage;
use App\Models\NewsViewer;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory, Sluggable;
    public $timestamps = true;
    protected $table = 'news';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'title',
        'slug',
        'description',
        'content',
        'image',
        'date',
        'address',
        'user_id',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function newsImage()
    {
        return $this->hasMany(NewsImage::class);
    }
    
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function newsViewer()
    {
        return $this->hasMany(NewsViewer::class);
    }
}
