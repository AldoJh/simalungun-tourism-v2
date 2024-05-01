<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventImage extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'Event_images';
    protected $primaryKey = 'id';

    protected $fillable = [
        'news_id',
        'image',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
