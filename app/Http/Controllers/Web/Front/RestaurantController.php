<?php

namespace App\Http\Controllers\Web\Front;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\RestaurantViewer;
use App\Http\Controllers\Controller;
use App\Models\RestaurantReview;
use App\Models\RestaurantVisitor;
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

    public function show($slug, Request $request) {
        $restaurant =  Restaurant::where('slug', $slug)->first();

         // Ambil tahun dari request jika tersedia, atau gunakan sekarang sebagai default
         $tahun = $request->input('tahun', date('Y'));
         $visitorData = RestaurantVisitor::where('restaurant_id', $restaurant->id)
             ->whereYear('date', $tahun)
             ->get();
         $monthlyVisitor = [];
         for ($i = 1; $i <= 12; $i++) {
             $monthlyVisitor[$i] = 0;
         }
         foreach ($visitorData as $visitor) {
             $month = date('n', strtotime($visitor->date)); 
             $monthlyVisitor[$month] += (int)$visitor->visitor;
         }
         $result = array_values($monthlyVisitor);
 
         // Array 5 tahun kebelakang
         $fiveYearsAgo = [];
         for ($i = 0; $i < 5; $i++) {
             $fiveYearsAgo[] = (int)date('Y', strtotime("-$i year"));
         }

        $viewer = New RestaurantViewer();
        $viewer->restaurant_id = $restaurant->id;
        $viewer->user_id = Auth::user()->id ?? null;
        $viewer->save();

        $data = [
            'title' => 'Restaurant',
            'subTitle' => null,
            'page_id' => null,
            'restaurant' => $restaurant,
            'review' => RestaurantReview::where('restaurant_id', $restaurant->id)->orderBy('created_at', 'desc')->limit(5)->get(),
            'visitor' => $result,
            'tahun' => $fiveYearsAgo
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
