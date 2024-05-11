<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tourism;
use App\Models\TourismReview;
use App\Models\TourismVisitor;
use Illuminate\Http\Request;

class TourismController extends Controller
{
    public function tourism(Request $request){
        $search = $request->input('q');
        $data = Tourism::where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'asc')->paginate(10);
        $data->appends(['q' => $search]);
        $data = [
            'title' => 'Wisata',
            'subTitle' => 'Data Wisata',
            'page_id' => 4,
            'tourism' => $data
        ];
        return view('admin.pages.tourism.tourism',  $data);
    }

    public function review(){
        $data = [
            'title' => 'Wisata',
            'subTitle' => 'Review',
            'page_id' => 5,
            'review' => TourismReview::paginate(10)
        ];
        return view('admin.pages.tourism.review',  $data);
    }

    public function reviewDestroy($id){
        $review = TourismReview::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.wisata.review')->with('success','Berhasil menghapus review');
    }

    public function visitor(){
        $data = [
            'title' => 'Wisata',
            'subTitle' => 'Pengunjung',
            'page_id' => 5,
            'visitor' => TourismVisitor::paginate(10)
        ];
        return view('admin.pages.tourism.visitor',  $data);
    }
}
