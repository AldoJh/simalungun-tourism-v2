<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TourismController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Wisata',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('front.pages.tourism.index',  $data);
    }
}
