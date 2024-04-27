<?php

namespace App\Models;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsViewer extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'news_viewer';
    protected $primaryKey = 'id';

    protected $fillable = [
        'news_id',
        'user_id',
    ];

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
