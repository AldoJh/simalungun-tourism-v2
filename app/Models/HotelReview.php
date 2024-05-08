<?php

namespace App\Models;

use App\Models\User;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelReview extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'hotel_reviews';
    protected $primaryKey = 'id';

    protected $fillable = [
        'hotel_id',
        'user_id',
        'rating',
        'comment'
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

     
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
