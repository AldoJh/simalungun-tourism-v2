<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestaurantImage extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'restaurant_images';
    protected $primaryKey = 'id';

    protected $fillable = [
        'restaurant_id',
        'image',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
