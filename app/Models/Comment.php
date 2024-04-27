<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'comments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'news_id',
        'user_id',
        'content',
    ];

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
