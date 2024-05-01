<?php

namespace App\Models;

use App\Models\District;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventVisitor extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'event_visitors';
    protected $primaryKey = 'id';

    protected $fillable = [
        'event_id',
        'district_id',
        'visitor',
        'attachment',
        'date',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
    
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
