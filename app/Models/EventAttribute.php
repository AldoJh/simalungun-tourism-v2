<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventAttribute extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'event_attributes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'event_id',
        'name',
        'description',
        'value',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
