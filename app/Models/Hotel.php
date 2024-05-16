<?php

namespace App\Models;

use App\Models\Village;
use App\Models\District;
use App\Models\HotelAdmin;
use App\Models\HotelImage;
use App\Models\HotelReview;
use App\Models\HotelViewer;
use App\Models\HotelVisitor;
use App\Models\HotelFacility;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory, Sluggable;
    public $timestamps = true;
    protected $table = 'hotels';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'address',
        'excerpt',
        'slug',
        'image',
        'phone',
        'room',
        'latitude',
        'longitude',
        'category_id',
        'district_id',
        'village_id',
        'owner',
        'min_price',
        'max_price',
        'is_verified'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    
    public function hotelCategory(): BelongsTo
    {
        return $this->belongsTo(HotelCategory::class, 'category_id', 'id');
    }

    public function hotelImage()
    {
        return $this->hasMany(HotelImage::class);
    }

    public function hotelReview()
    {
        return $this->hasMany(HotelReview::class);
    }

    public function hotelViewer()
    {
        return $this->hasMany(HotelViewer::class);
    }

    public function hotelVisitor()
    {
        return $this->hasMany(HotelVisitor::class);
    }

    public function hotelAdmin()
    {
        return $this->hasMany(HotelAdmin::class);
    }

    public function hotelFacility()
    {
        return $this->hasMany(HotelFacility::class);
    }
}
