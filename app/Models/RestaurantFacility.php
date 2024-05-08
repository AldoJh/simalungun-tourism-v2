<?php

namespace App\Models;

use App\Models\Facility;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestaurantFacility extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'restaurant_facilities';
    protected $primaryKey = 'id';

    protected $fillable = [
        'restaurant_id',
        'user_id',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

     
    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }
}
