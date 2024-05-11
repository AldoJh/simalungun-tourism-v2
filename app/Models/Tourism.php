<?php

namespace App\Models;

use App\Models\TourismAdmin;
use App\Models\TourismGuide;
use App\Models\TourismImage;
use App\Models\TourismReview;
use App\Models\TourismViewer;
use App\Models\TourismVisitor;
use App\Models\TourismCategory;
use App\Models\TourismFacility;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tourism extends Model
{
    use HasFactory, Sluggable;
    public $timestamps = true;
    protected $table = 'tourisms';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'category_id',
        'name',
        'address',
        'excerpt',
        'slug',
        'image',
        'phone',
        'latitude',
        'longitude',
        'category_id',
        'district_id',
        'village_id',
        'is_recomended'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function tourismCategory(): BelongsTo
    {
        return $this->belongsTo(TourismCategory::class, 'category_id', 'id');
    }

    public function tourismGuide()
    {
        return $this->hasMany(TourismGuide::class);
    }

    public function tourismImage()
    {
        return $this->hasMany(TourismImage::class);
    }

    public function tourismReview()
    {
        return $this->hasMany(TourismReview::class);
    }

    public function tourismViewer()
    {
        return $this->hasMany(TourismViewer::class);
    }

    public function tourismVisitor()
    {
        return $this->hasMany(TourismVisitor::class);
    }

    public function tourismAdmin()
    {
        return $this->hasMany(TourismAdmin::class);
    }

    public function tourismFacility()
    {
        return $this->hasMany(TourismFacility::class);
    }
}