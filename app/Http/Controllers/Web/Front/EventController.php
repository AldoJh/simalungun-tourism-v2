<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

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

    public function show($slug){
        $data = [
            'title' => 'Festival',
            'subTitle' => null,
            'page_id' => null,
            'event' => Event::where('slug', $slug)->firstOrFail()
        ];
        return view('front.pages.event.show',  $data);
    }
}
