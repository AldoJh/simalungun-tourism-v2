<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'settings';
    protected $primaryKey = 'id';

    protected $fillable = [
        'site_name',
        'description',
        'email',
        'whatsapp',
        'instagram',
        'facebook',
    ];

    public static function webBase()
    {
        $data = static::findOrFail(1);
        return $data;
    }
}
