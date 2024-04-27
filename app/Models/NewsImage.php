<?php

namespace App\Models;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsImage extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'news_image';
    protected $primaryKey = 'id';

    protected $fillable = [
        'news_id',
        'image',
    ];

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }
}
