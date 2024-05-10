<?php

namespace App\Http\Controllers\Web\Front;

use App\Models\Tourism;
use Illuminate\Http\Request;
use App\Models\TourismViewer;
use App\Http\Controllers\Controller;
use App\Models\TourismReview;
use App\Models\TourismVisitor;
use Illuminate\Support\Facades\Auth;

class TourismController extends Controller
{
    public function index(Request $request){
        $search = $request->input('q');
        $data = Tourism::where('name', 'LIKE', '%' . $search . '%')->orderBy('is_recomended', 'desc')->orderBy('created_at', 'asc')->paginate(12);
        $data->appends(['q' => $search]);
        $data = [
            'title' => 'Wisata',
            'subTitle' => null,
            'page_id' => null,
            'tourism' => $data
        ];
        return view('front.pages.tourism.index',  $data);
    }

    public function show($slug, Request $request){
        $tourism =  Tourism::where('slug', $slug)->firstOrFail();
    
        // Ambil tahun dari request jika tersedia, atau gunakan sekarang sebagai default
        $tahun = $request->input('tahun', date('Y'));
        $visitorData = TourismVisitor::where('tourism_id', $tourism->id)
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
    
        $viewer = new TourismViewer();
        $viewer->tourism_id = $tourism->id;
        $viewer->user_id = Auth::user()->id ?? null;
        $viewer->save();
    
        $data = [
            'title' => 'Wisata',
            'subTitle' => null,
            'page_id' => null,
            'tourism' => $tourism,
            'review' => TourismReview::where('tourism_id', $tourism->id)->orderBy('created_at', 'desc')->limit(5)->get(),
            'visitor' => $result,
            'tahun' => $fiveYearsAgo
        ];
    
    
        return view('front.pages.tourism.show', $data);
    }

    public function store($id, Request $request){
        $review = New TourismReview();
        $review->tourism_id = $id;
        $review->user_id = Auth::user()->id;
        $review->rating = $request->rate;
        $review->comment = $request->comment;
        $review->save();
        return redirect()->back();
    }
}
