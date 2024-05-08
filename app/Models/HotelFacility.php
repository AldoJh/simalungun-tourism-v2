<?php

namespace App\Models;

use App\Models\Hotel;
use App\Models\Facility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelFacility extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'hotel_facilities';
    protected $primaryKey = 'id';

    protected $fillable = [
        'hotel_id',
        'facility_id',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

     
    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }
}
