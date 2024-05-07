<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestaurantMenu extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'restaurant_menus';
    protected $primaryKey = 'id';

    protected $fillable = [
        'restaurant_id',
        'name',
        'type',
        'price',
        'image',
        'description',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
