<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function news(){
        $data = [
            'title' => 'Berita',
            'subTitle' => 'Data Berita',
            'page_id' => 6,
            'news' => News::all()
        ];
        return view('admin.pages.news.news',  $data);
    }
}
