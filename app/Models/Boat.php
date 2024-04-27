<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boat extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'boats';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'owner',
        'address',
        'phone',
        'route',
        'updated_by',
    ];
}
