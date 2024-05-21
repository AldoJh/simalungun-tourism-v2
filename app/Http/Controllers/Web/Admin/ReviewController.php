<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Tourism;
use App\Models\HotelReview;
use Illuminate\Http\Request;
use App\Models\TourismReview;
use App\Models\RestaurantReview;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function tourism(){
        $data = [
            'title' => 'Review',
            'subTitle' => 'Wisata',
            'page_id' => null,
            'tourism' => TourismReview::where('user_id', Auth::user()->id)->get()
        ];
        return view('admin.pages.review.tourism',  $data);
    }

    public function tourismDestroy($id){
        $review = TourismReview::where('user_id', Auth::user()->id)->where('id', $id);
        $review->delete();
        return redirect()->route('my-review.wisata')->with('success','Berhasil menghapus review');
    }

    public function hotel(){
        $data = [
            'title' => 'Review',
            'subTitle' => 'Hotel',
            'page_id' => null,
            'hotel' => HotelReview::where('user_id', Auth::user()->id)->get()
        ];
        return view('admin.pages.review.hotel',  $data);
    }
    
    public function hotelDestroy($id){
        $review = HotelReview::where('user_id', Auth::user()->id)->where('id', $id);
        $review->delete();
        return redirect()->route('my-review.hotel')->with('success','Berhasil menghapus review');
    }

    public function restaurant(){
        $data = [
            'title' => 'Review',
            'subTitle' => 'Restoran',
            'page_id' => null,
            'restaurant' => RestaurantReview::where('user_id', Auth::user()->id)->get()
        ];
        return view('admin.pages.review.restaurant',  $data);
    }
    
    public function restaurantDestroy($id){
        $review = RestaurantReview::where('user_id', Auth::user()->id)->where('id', $id);
        $review->delete();
        return redirect()->route('my-review.restoran')->with('success','Berhasil menghapus review');
    }
}
