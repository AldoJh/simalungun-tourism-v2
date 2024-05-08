<?php

namespace App\Models;

use App\Models\User;
use App\Models\Tourism;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourismReview extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'tourism_reviews';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tourism_id',
        'user_id',
        'rating',
        'comment'
    ];

    public function tourism(): BelongsTo
    {
        return $this->belongsTo(Tourism::class);
    }

     
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
