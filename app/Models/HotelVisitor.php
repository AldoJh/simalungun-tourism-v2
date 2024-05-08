<?php

namespace App\Models;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelVisitor extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'hotel_visitors';
    protected $primaryKey = 'id';

    protected $fillable = [
        'hotel_id',
        'visitor',
        'room',
        'attachment',
        'date',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
}
