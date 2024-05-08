<?php

namespace App\Models;

use App\Models\Tourism;
use App\Models\Facility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourismFacility extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'tourism_facilities';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tourism_id',
        'facility_id',
    ];

    public function tourism(): BelongsTo
    {
        return $this->belongsTo(Tourism::class);
    }

     
    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }
}
