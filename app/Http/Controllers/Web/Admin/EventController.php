<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EventImage;
use Illuminate\Support\Facades\Validator;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;

class EventController extends Controller
{
    public function event(Request $request){
        $search = $request->input('q');
        $data = Event::where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'desc')->paginate(10);
        $data->appends(['q' => $search]);
        $data = [
            'title' => 'Festival',
            'subTitle' => 'Data Festival',
            'page_id' => 6,
            'event' => $data
        ];
        return view('admin.pages.event.event',  $data);
    }

    public function eventAdd(){
        $data = [
            'title' => 'Festival',
            'subTitle' => 'Tambah Festival',
            'page_id' => 6,
        ];
        return view('admin.pages.event.add',  $data);
    }

    public function eventStore(Request $request){
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'required|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'price' => 'required',
            'date' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.festival.festival.add')->with('error', 'Gagal menambahkan festival baru')->withInput()->withErrors($validator);
        }
        $id = UniqueIdGenerator::generate(['table' => 'events', 'length' => 9, 'prefix' => date('ymd')]);
        $imagePath = $request->file('thumbnail')->store('event', 'public');

        $news = New Event();
        $news->id = $id;
        $news->name = $request->input('name');
        $news->date = $request->input('date');
        $news->price = $request->input('price');
        $news->address = $request->input('location');
        $news->latitude = $request->input('lat');
        $news->longitude = $request->input('long');
        $news->description = $request->input('description');
        $news->image =  $imagePath;
        $news->save();

        $newsImage = New EventImage();
        $newsImage->event_id = $id;
        $newsImage->image = $imagePath;
        $newsImage->save();

        return redirect()->route('admin.festival.festival.komentar', $id)->with('success', 'Berhasil menambahkan festival baru');
    }
}
