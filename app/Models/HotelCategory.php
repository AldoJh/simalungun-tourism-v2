<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelCategory extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'hotel_categories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];
}
