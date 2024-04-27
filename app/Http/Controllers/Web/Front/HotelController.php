<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Hotel',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('front.pages.hotel.index',  $data);
    }

    public function show($slug){
        $data = [
            'title' => 'Hotel',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('front.pages.hotel.show',  $data);
    }
}
