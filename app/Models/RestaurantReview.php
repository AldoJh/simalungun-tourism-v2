<?php

namespace App\Models;

use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestaurantReview extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'restaurant_reviews';
    protected $primaryKey = 'id';

    protected $fillable = [
        'restaurant_id',
        'user_id',
        'rating',
        'comment'
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

     
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
