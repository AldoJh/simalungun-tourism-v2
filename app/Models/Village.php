<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'villages';
    protected $primaryKey = 'id';

    protected $fillable = [
        'code',
        'district_code',
        'name',
        'meta',
    ];
}
