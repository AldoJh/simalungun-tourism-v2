<?php

namespace App\Http\Controllers\Web\Front;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\RestaurantViewer;
use App\Http\Controllers\Controller;
use App\Models\RestaurantReview;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index(Request $request){
        $search = $request->input('q');
        $data = Restaurant::where('name', 'LIKE', '%' . $search . '%')->orderBy('is_recomended', 'desc')->orderBy('created_at', 'ASC')->paginate(12);
        $data->appends(['q' => $search]);
        $data = [
            'title' => 'Restaurant',
            'subTitle' => null,
            'page_id' => null,
            'restaurant' => $data
        ];
        return view('front.pages.restaurant.index',  $data);
    }

    public function show($slug) {
        $restaurant =  Restaurant::where('slug', $slug)->first();

        $viewer = New RestaurantViewer();
        $viewer->restaurant_id = $restaurant->id;
        $viewer->user_id = Auth::user()->id ?? null;
        $viewer->save();

        $data = [
            'title' => 'Restaurant',
            'subTitle' => null,
            'page_id' => null,
            'restaurant' => $restaurant,
            'review' => RestaurantReview::where('restaurant_id', $restaurant->id)->orderBy('created_at', 'desc')->limit(5)->get()
        ];
        return view('front.pages.restaurant.show',  $data);
    }

    public function store($id, Request $request){
        $review = New RestaurantReview();
        $review->restaurant_id = $id;
        $review->user_id = Auth::user()->id;
        $review->rating = $request->rate;
        $review->comment = $request->comment;
        $review->save();
        return redirect()->back();
    }
}
