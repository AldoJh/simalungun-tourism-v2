<?php

namespace App\Models;

use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestaurantViewer extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'restaurant_viewers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'restaurant_id',
        'user_id',
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
