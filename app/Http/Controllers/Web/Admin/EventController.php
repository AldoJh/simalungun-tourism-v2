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

        $event = New Event();
        $event->id = $id;
        $event->name = $request->input('name');
        $event->date = $request->input('date');
        $event->price = $request->input('price');
        $event->address = $request->input('location');
        $event->latitude = $request->input('lat');
        $event->longitude = $request->input('long');
        $event->description = $request->input('description');
        $event->image =  $imagePath;
        $event->save();

        $eventImage = New EventImage();
        $eventImage->event_id = $id;
        $eventImage->image = $imagePath;
        $eventImage->save();

        return redirect()->route('admin.festival.festival.pengunjung', $id)->with('success', 'Berhasil menambahkan festival baru');
    }

    public function eventEdit($id){
        $data = [
            'title' => 'Festival',
            'subTitle' => 'Edit Festival',
            'page_id' => 7,
            'event' => Event::findOrFail($id),
        ];
        return view('admin.pages.event.edit',  $data);
    }
    
    public function eventUpdate($id, Request $request){
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'nullable|sometimes|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'price' => 'required',
            'date' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.festival.festival.edit', $id)->with('error', 'Gagal merubah data festival')->withInput()->withErrors($validator);
        }

        $event = Event::findOrFail($id);
        $event->name = $request->input('name');
        $event->date = $request->input('date');
        $event->price = $request->input('price');
        $event->address = $request->input('location');
        $event->latitude = $request->input('lat');
        $event->longitude = $request->input('long');
        $event->description = $request->input('description');
        if($request->has('thumbnail')){
            $event->image =   $request->file('thumbnail')->store('news', 'public');
        }
        $event->save();
        return redirect()->route('admin.festival.festival.pengunjung', $id)->with('success', 'Berhasil menambahkan data festival');
    }

    public function eventDestroy($id){
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('admin.festival.festival')->with('success','Berhasil menghapus festival');
    }
}
