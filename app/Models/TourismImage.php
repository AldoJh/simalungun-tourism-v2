<?php

namespace App\Models;

use App\Models\Tourism;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourismImage extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'tourism_images';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tourism_id',
        'image',
    ];

    public function tourism(): BelongsTo
    {
        return $this->belongsTo(Tourism::class);
    }
}
