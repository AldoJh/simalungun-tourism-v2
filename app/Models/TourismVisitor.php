<?php

namespace App\Models;

use App\Models\Tourism;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourismVisitor extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'tourism_visitors';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tourism_id',
        'visitor',
        'attachment',
        'date',
    ];

    public function tourism(): BelongsTo
    {
        return $this->belongsTo(Tourism::class);
    }
}