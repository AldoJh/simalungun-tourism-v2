<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestaurantVisitor extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'restaurant_visitors';
    protected $primaryKey = 'id';

    protected $fillable = [
        'restaurant_id',
        'visitor',
        'attachment',
        'date',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
