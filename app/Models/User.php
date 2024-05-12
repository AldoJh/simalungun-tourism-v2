<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\EventAdmin;
use App\Models\HotelAdmin;
use App\Models\TourismAdmin;
use App\Models\RestaurantAdmin;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tourism()
    {
        return $this->hasMany(TourismAdmin::class);
    }

    public function hotel()
    {
        return $this->hasMany(HotelAdmin::class);
    }

    public function restaurant()
    {
        return $this->hasMany(RestaurantAdmin::class);
    }

    public function event()
    {
        return $this->hasMany(EventAdmin::class);
    }
}
