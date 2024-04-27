<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismCategory extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'tourism_categories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];
}
