<?php

namespace App\Http\Controllers\Web\Front;

use App\Models\Event;
use App\Models\EventViewer;
use App\Models\EventVisitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request){
        $search = $request->input('q');
        $data = Event::where('name', 'LIKE', '%' . $search . '%')->orderBy('date', 'asc')->paginate(12);
        $data->appends(['q' => $search]);
        $data = [
            'title' => 'Festival',
            'subTitle' => null,
            'page_id' => null,
            'event' => $data
        ];
        return view('front.pages.event.index',  $data);
    }

    public function show($slug, Request $request){
        $event = Event::where('slug', $slug)->firstOrFail();

        // Ambil tahun dari request jika tersedia, atau gunakan sekarang sebagai default
        $tahun = $request->input('tahun', date('Y'));
        $visitorData = EventVisitor::where('event_id', $event->id)
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

        $viewer = new EventViewer();
        $viewer->event_id = $event->id;
        $viewer->user_id = Auth::user()->id ?? null;
        $viewer->save();

        $data = [
            'title' => 'Festival',
            'subTitle' => null,
            'page_id' => null,
            'event' => $event,
            'visitor' => $result,
            'tahun' => $fiveYearsAgo
        ];
        return view('front.pages.event.show',  $data);
    }
}
