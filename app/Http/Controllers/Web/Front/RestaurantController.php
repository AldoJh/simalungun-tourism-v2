<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Restaurant',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('front.pages.restaurant.index',  $data);
    }
}
