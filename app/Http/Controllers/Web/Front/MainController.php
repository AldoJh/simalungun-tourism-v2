<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Home',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('front.pages.main',  $data);
    }
}
