<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Festival',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('front.pages.event.index',  $data);
    }
}
