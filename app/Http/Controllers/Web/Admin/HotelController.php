<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelReview;
use App\Models\HotelVisitor;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function hotel(Request $request){
        $search = $request->input('q');
        $data = Hotel::where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'asc')->paginate(10);
        $data->appends(['q' => $search]);
        $data = [
            'title' => 'Hotel',
            'subTitle' => 'Data Hotel',
            'page_id' => 4,
            'hotel' => $data
        ];
        return view('admin.pages.hotel.hotel',  $data);
    }

    public function review(){
        $data = [
            'title' => 'Hotel',
            'subTitle' => 'Review',
            'page_id' => 5,
            'review' => HotelReview::paginate(10)
        ];
        return view('admin.pages.hotel.review',  $data);
    }

    public function reviewDestroy($id){
        $review = HotelReview::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.hotel.review')->with('success','Berhasil menghapus review');
    }

    public function visitor(){
        $data = [
            'title' => 'Hotel',
            'subTitle' => 'Pengunjung',
            'page_id' => 5,
            'visitor' => HotelVisitor::paginate(10)
        ];
        return view('admin.pages.hotel.visitor',  $data);
    }
}
