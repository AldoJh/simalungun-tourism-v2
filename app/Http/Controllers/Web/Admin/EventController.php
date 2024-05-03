<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EventAttribute;
use App\Models\EventImage;
use App\Models\EventVisitor;
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
            $event->image =   $request->file('thumbnail')->store('event', 'public');
        }
        $event->save();
        return redirect()->route('admin.festival.festival.pengunjung', $id)->with('success', 'Berhasil menambahkan data festival');
    }

    public function eventDestroy($id){
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('admin.festival.festival')->with('success','Berhasil menghapus festival');
    }

    public function eventVisitor($id){
        $event = Event::findOrFail($id);
        $data = [
            'title' => 'Festival',
            'subTitle' => $event->slug,
            'page_id' => 7,
            'event' => $event,
            'visitor' => EventVisitor::where('event_id', $id)->paginate(10),
        ];
        return view('admin.pages.event.event_visitor',  $data);
    }

    
    public function eventVisitorStore($id, Request $request){
        $validator = Validator::make($request->all(), [
            'attachment' => 'required|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'date' => 'required',
            'visitor' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.festival.festival.pengunjung', $id)->with('error', 'Gagal menambahkan data pengunjung')->withInput()->withErrors($validator);
        }
        $event = New EventVisitor();
        $event->event_id = $id;
        $event->date = $request->input('date');
        $event->visitor = $request->input('visitor');
        $event->attachment =  $request->file('attachment')->store('pengunjung-event', 'public');
        $event->save();
        return redirect()->route('admin.festival.festival.pengunjung', $id)->with('success', 'Berhasil menambahkan data pengunjung');
    }

    public function eventVisitorUpdate($id, $idVisitor, Request $request){
        $validator = Validator::make($request->all(), [
            'attachment' => 'nullable|sometimes|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'date' => 'required',
            'visitor' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.festival.festival.pengunjung', $id)->with('error', 'Gagal mengubah data pengunjung')->withInput()->withErrors($validator);
        }
        $event = EventVisitor::findOrFail($idVisitor);
        $event->event_id = $id;
        $event->date = $request->input('date');
        $event->visitor = $request->input('visitor');
        if($request->has('attachment')){
            $event->attachment =  $request->file('attachment')->store('pengunjung-event', 'public');
        }
        $event->save();
        return redirect()->route('admin.festival.festival.pengunjung', $id)->with('success', 'Berhasil mengubah data pengunjung');
    }

    public function eventVisitorDestroy($id, $idVisitor){
        $comment = EventVisitor::findOrFail($idVisitor);
        $comment->delete();
        return redirect()->route('admin.festival.festival.pengunjung', $id)->with('success','Berhasil menghapus data  pengunjung');
    }

    public function eventGallery($id){
        $event = Event::findOrFail($id);
        $data = [
            'title' => 'Festival',
            'subTitle' => $event->slug,
            'page_id' => 7,
            'event' => $event,
            'gallery' => EventImage::where('event_id', $id)->get()
        ];
        return view('admin.pages.event.event_gallery',  $data);
    }

    public function eventGalleryStore($id, Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,bmp,png,jpg,svg|max:5000',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.festival.festival.galeri', $id)->with('error', 'Gagal menambahkan gambar')->withInput()->withErrors($validator);
        }
        $eventImage = New EventImage();
        $eventImage->event_id = $id;
        $eventImage->image = $request->file('image')->store('event/collection', 'public');
        $eventImage->save();
        return redirect()->route('admin.festival.festival.galeri', $id)->with('success', 'Berhasil menambahkan gambar');
    }

    public function eventGalleryDestroy($id, $idGallery){
        $eventImage = EventImage::findOrFail($idGallery);
        $eventImage->delete();
        return redirect()->route('admin.festival.festival.galeri', $id)->with('success','Berhasil menghapus gambar');
    }

    public function eventAttribute($id){
        $event = Event::findOrFail($id);
        $data = [
            'title' => 'Festival',
            'subTitle' => $event->slug,
            'page_id' => 7,
            'event' => $event,
            'attribute' => EventAttribute::where('event_id', $id)->paginate(10)
        ];
        return view('admin.pages.event.event_attribute',  $data);
    }
}
