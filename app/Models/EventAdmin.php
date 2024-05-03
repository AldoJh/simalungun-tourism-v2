<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventAdmin extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'event_admins';
    protected $primaryKey = 'id';

    protected $fillable = [
        'event_id',
        'user_id',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

     
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
