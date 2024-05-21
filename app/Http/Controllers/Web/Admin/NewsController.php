<?php

namespace App\Http\Controllers\Web\Admin;

use Carbon\Carbon;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\NewsImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;

class NewsController extends Controller
{
    public function news(Request $request){
        $search = $request->input('q');
        $data = News::where('title', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'desc')->paginate(10);
        $data->appends(['q' => $search]);
        $data = [
            'title' => 'Berita',
            'subTitle' => 'Data Berita',
            'page_id' => 7,
            'news' => $data
        ];
        return view('admin.pages.news.news',  $data);
    }

    public function newsAdd(){
        $data = [
            'title' => 'Berita',
            'subTitle' => 'Tambah Berita',
            'page_id' => 7,
        ];
        return view('admin.pages.news.add',  $data);
    }

    public function newsStore(Request $request){
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'required|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'description' => 'required',
            'title' => 'required',
            'location' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.berita.berita.add')->with('error', 'Gagal menambahkan berita baru')->withInput()->withErrors($validator);
        }
        $id = UniqueIdGenerator::generate(['table' => 'news', 'length' => 9, 'prefix' => date('ymd')]);
        $imagePath = $request->file('thumbnail')->store('news', 'public');

        $news = New News();
        $news->id = $id;
        $news->title = $request->input('title');
        $news->description = $request->input('description');
        $news->content = $request->input('content');
        $news->image =  $imagePath;
        $news->address = $request->input('location');
        $news->content = $request->input('content');
        $news->date = Carbon::now();
        $news->user_id = Auth::user()->id;
        $news->save();

        $newsImage = New NewsImage();
        $newsImage->news_id = $id;
        $newsImage->image = $imagePath;
        $newsImage->save();

        return redirect()->route('admin.berita.berita.komentar', $id)->with('success', 'Berhasil menambahkan berita baru');
    }

    public function newsEdit($id){
        $data = [
            'title' => 'Berita',
            'subTitle' => 'Edit Berita',
            'page_id' => 7,
            'news' => News::findOrFail($id),
        ];
        return view('admin.pages.news.edit',  $data);
    }

    public function newsUpdate($id, Request $request){
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'nullable|sometimes|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'description' => 'required',
            'title' => 'required',
            'location' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.berita.berita.eddit', $id)->with('error', 'Gagal mengubah berita')->withInput()->withErrors($validator);
        }

        $news = News::findOrFail($id);
        $news->title = $request->input('title');
        $news->description = $request->input('description');
        $news->content = $request->input('content');
        if($request->has('thumbnail')){
            $news->image =   $request->file('thumbnail')->store('news', 'public');
        }
        $news->address = $request->input('location');
        $news->content = $request->input('content');
        $news->save();

        return redirect()->route('admin.berita.berita.komentar', $id)->with('success', 'Berhasil mengubah berita');
    }

    public function newsDestroy($id){
        $news = News::findOrFail($id);
        $news->delete();
        return redirect()->route('admin.berita.berita')->with('success','Berhasil menghapus berita');
    }

    public function newsComment($id){
        $news = News::findOrFail($id);
        $data = [
            'title' => 'Berita',
            'subTitle' => $news->slug,
            'page_id' => 7,
            'news' => $news,
            'komentar' => Comment::where('news_id', $id)->get()
        ];
        return view('admin.pages.news.news_comment',  $data);
    }

    public function newsCommentDestroy($id, $idComment){
        $comment = Comment::findOrFail($idComment);
        $comment->delete();
        return redirect()->route('admin.berita.berita.komentar', $id)->with('success','Berhasil menghapus komentar');
    }

    public function newsGallery($id){
        $news = News::findOrFail($id);
        $data = [
            'title' => 'Berita',
            'subTitle' => $news->slug,
            'page_id' => 7,
            'news' => $news,
            'gallery' => NewsImage::where('news_id', $id)->get()
        ];
        return view('admin.pages.news.news_gallery',  $data);
    }

    public function newsGalleryStore($id, Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,bmp,png,jpg,svg|max:5000',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.berita.berita.galeri', $id)->with('error', 'Gagal menambahkan gambar')->withInput()->withErrors($validator);
        }
        $newsImage = New NewsImage();
        $newsImage->news_id = $id;
        $newsImage->image = $request->file('image')->store('news/collection', 'public');
        $newsImage->save();
        return redirect()->route('admin.berita.berita.galeri', $id)->with('success', 'Berhasil menambahkan gambar');
    }

    public function newsGalleryDestroy($id, $idGallery){
        $newsGallery = NewsImage::findOrFail($idGallery);
        $newsGallery->delete();
        return redirect()->route('admin.berita.berita.galeri', $id)->with('success','Berhasil menghapus gambar');
    }

    public function comment(){
        $data = [
            'title' => 'Berita',
            'subTitle' => 'Komentar',
            'page_id' => 7,
            'comment' => Comment::paginate(10)
        ];
        // dd($data);
        return view('admin.pages.news.comment',  $data);
    }

    public function commentDestroy($id){
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->route('admin.berita.komentar')->with('success','Berhasil menghapus komentar');
    }
}
