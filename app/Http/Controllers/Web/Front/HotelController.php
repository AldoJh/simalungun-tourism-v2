<?php

namespace App\Http\Controllers\Web\Front;

use App\Models\Hotel;
use App\Models\HotelViewer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HotelReview;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    public function index(Request $request){
        $search = $request->input('q');
        $data = Hotel::where('name', 'LIKE', '%' . $search . '%')->orderBy('is_verified', 'desc')->orderBy('created_at', 'asc')->paginate(12);
        $data->appends(['q' => $search]);
        $data = [
            'title' => 'Hotel',
            'subTitle' => null,
            'page_id' => null,
            'hotel' => $data
        ];
        return view('front.pages.hotel.index',  $data);
    }

    public function show($slug){
        $hotel =  Hotel::where('slug', $slug)->first();

        $viewer = New HotelViewer();
        $viewer->hotel_id = $hotel->id;
        $viewer->user_id = Auth::user()->id ?? null;
        $viewer->save();
        $data = [
            'title' => 'Hotel',
            'subTitle' => null,
            'page_id' => null,
            'hotel' => $hotel,
            'review' => HotelReview::where('hotel_id', $hotel->id)->orderBy('created_at', 'desc')->limit(5)->get()
        ];
        return view('front.pages.hotel.show',  $data);
    }

    public function store($id, Request $request){
        $review = New HotelReview();
        $review->hotel_id = $id;
        $review->user_id = Auth::user()->id;
        $review->rating = $request->rate;
        $review->comment = $request->comment;
        $review->save();
        return redirect()->back();
    }
}
