<?php

namespace App\Http\Controllers\Web\Front;

use App\Models\News;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Tourism;

class MainController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Home',
            'subTitle' => null,
            'page_id' => null,
            'event' => Event::orderby('date', 'desc')->limit(4)->get(),
            'news' => News::orderby('created_at', 'desc')->limit(3)->get(),
            'tourism' => Tourism::orderBy('is_recomended', 'desc')->orderBy('created_at', 'asc')->limit(8)->get(),
            'hotel' => Hotel::orderBy('is_verified', 'desc')->orderBy('created_at', 'asc')->limit(8)->get(),
            'restaurant' => Restaurant::orderBy('is_recomended', 'desc')->orderBy('created_at', 'ASC')->limit(8)->get(),
        ];
        // dd($data);
        return view('front.pages.main',  $data);
    }
}
