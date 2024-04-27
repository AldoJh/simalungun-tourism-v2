<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Berita',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('front.pages.news.index',  $data);
    }

    public function show(){
        $data = [
            'title' => 'Berita',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('front.pages.news.show',  $data);
    }
}
