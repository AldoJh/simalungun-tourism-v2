<?php

namespace App\Models;

use App\Models\RestaurantMenu;
use App\Models\RestaurantAdmin;
use App\Models\RestaurantImage;
use App\Models\RestaurantReview;
use App\Models\RestaurantViewer;
use App\Models\RestaurantVisitor;
use App\Models\RestaurantFacility;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory, Sluggable;
    public $timestamps = true;
    protected $table = 'restaurants';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'owner',
        'address',
        'excerpt',
        'slug',
        'logo',
        'image',
        'phone',
        'latitude',
        'longitude',
        'district_id',
        'village_id',
        'chair',
        'table',
        'label',
        'is_recomended',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public function restaurantImage()
    {
        return $this->hasMany(RestaurantImage::class);
    }

    public function restaurantReview()
    {
        return $this->hasMany(RestaurantReview::class);
    }

    public function restaurantViewer()
    {
        return $this->hasMany(RestaurantViewer::class);
    }

    public function restaurantVisitor()
    {
        return $this->hasMany(RestaurantVisitor::class);
    }

    public function restaurantMenu()
    {
        return $this->hasMany(RestaurantMenu::class);
    }

    public function restaurantAdmin()
    {
        return $this->hasMany(RestaurantAdmin::class);
    }

    public function restaurantFacility()
    {
        return $this->hasMany(RestaurantFacility::class);
    }
}
