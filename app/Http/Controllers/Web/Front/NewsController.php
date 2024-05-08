<?php

namespace App\Http\Controllers\Web\Front;

use App\Models\News;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsViewer;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index(Request $request){
        $search = $request->input('q');
        $data = News::where('title', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'desc')->paginate(9);
        $data->appends(['q' => $search]);
        $data = [
            'title' => 'Berita',
            'subTitle' => null,
            'page_id' => null,
            'news' => $data,
            'tranding' => News::withCount('newsViewer')->orderByDesc('news_viewer_count')->take(6)->get()
        ];
        return view('front.pages.news.index',  $data);
    }

    public function show($slug){
        $news =  News::where('slug', $slug)->first();

        $viewer = New NewsViewer();
        $viewer->news_id = $news->id;
        $viewer->user_id = Auth::user()->id ?? null;
        $viewer->save();

        $data = [
            'title' => 'Berita',
            'subTitle' => null,
            'page_id' => null,
            'news' => $news,
            'tranding' => News::withCount('newsViewer')->orderByDesc('news_viewer_count')->take(5)->get()
        ];
        return view('front.pages.news.show',  $data);
    }

    public function store($id, Request $request){
        $comment = New Comment();
        $comment->news_id = $id;
        $comment->user_id = Auth::user()->id;
        $comment->content = $request->input('comment');
        $comment->save();
        return redirect()->back();
    }
}
