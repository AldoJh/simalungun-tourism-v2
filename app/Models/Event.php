<?php

namespace App\Models;

use App\Models\EventImage;
use App\Models\EventViewer;
use App\Models\EventVisitor;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, Sluggable;
    public $timestamps = true;
    protected $table = 'events';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'date',
        'price',
        'address',
        'latitude',
        'longitude',
        'description',
        'image',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public function eventImage()
    {
        return $this->hasMany(EventImage::class);
    }

    public function eventViewer()
    {
        return $this->hasMany(EventViewer::class);
    }

    public function eventVisitor()
    {
        return $this->hasMany(EventVisitor::class);
    }
}
