<?php

namespace App\Http\Controllers\Web\Front;

use App\Models\Hotel;
use App\Models\HotelViewer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HotelReview;
use App\Models\HotelVisitor;
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

    public function show($slug, Request $request){
        $hotel =  Hotel::where('slug', $slug)->first();

         // Ambil tahun dari request jika tersedia, atau gunakan sekarang sebagai default
         $tahun = $request->input('tahun', date('Y'));
         $visitorData = HotelVisitor::where('hotel_id', $hotel->id)
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

        $viewer = New HotelViewer();
        $viewer->hotel_id = $hotel->id;
        $viewer->user_id = Auth::user()->id ?? null;
        $viewer->save();
        $data = [
            'title' => 'Hotel',
            'subTitle' => null,
            'page_id' => null,
            'hotel' => $hotel,
            'review' => HotelReview::where('hotel_id', $hotel->id)->orderBy('created_at', 'desc')->limit(5)->get(),
            'visitor' => $result,
            'tahun' => $fiveYearsAgo
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
