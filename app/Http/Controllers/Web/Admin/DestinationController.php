<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\EventAdmin;
use App\Models\HotelAdmin;
use App\Models\TourismAdmin;
use Illuminate\Http\Request;
use App\Models\RestaurantAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DestinationController extends Controller
{
    public function tourism(){
        $data = [
            'title' => 'Admin Destinasi',
            'subTitle' => 'Wisata',
            'page_id' => null,
            'tourism' => TourismAdmin::where('user_id', Auth::user()->id)->get()
        ];
        return view('admin.pages.destination.tourism',  $data);
    }

    public function hotel(){
        $data = [
            'title' => 'Admin Destinasi',
            'subTitle' => 'Hotel',
            'page_id' => null,
            'hotel' => HotelAdmin::where('user_id', Auth::user()->id)->get()
        ];
        return view('admin.pages.destination.hotel',  $data);
    }

    public function restaurant(){
        $data = [
            'title' => 'Admin Destinasi',
            'subTitle' => 'Restoran',
            'page_id' => null,
            'restaurant' => RestaurantAdmin::where('user_id', Auth::user()->id)->get()
        ];
        return view('admin.pages.destination.restaurant',  $data);
    }

    public function event(){
        $data = [
            'title' => 'Admin Destinasi',
            'subTitle' => 'Festiival',
            'page_id' => null,
            'event' => EventAdmin::where('user_id', Auth::user()->id)->get()
        ];
        return view('admin.pages.destination.event',  $data);
    }
}
