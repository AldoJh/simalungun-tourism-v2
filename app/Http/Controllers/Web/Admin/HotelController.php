<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Hotel;
use App\Models\HotelReview;
use App\Models\HotelVisitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function hotel(Request $request){
        $search = $request->input('q');
        $data = Hotel::where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'asc')->paginate(10);
        $data->appends(['q' => $search]);
        $data = [
            'title' => 'Hotel',
            'subTitle' => 'Data Hotel',
            'page_id' => 4,
            'hotel' => $data
        ];
        return view('admin.pages.hotel.hotel',  $data);
    }
    
    public function hotelVisitor($id){
        $hotel = Hotel::findOrFail($id);
        $data = [
            'title' => 'Hotel',
            'subTitle' => $hotel->slug,
            'page_id' => 4,
            'hotel' => $hotel,
            'visitor' => HotelVisitor::where('hotel_id', $id)->paginate(10),
        ];
        return view('admin.pages.hotel.hotel_visitor',  $data);
    }

    public function hotelVisitorStore($id, Request $request){
        $validator = Validator::make($request->all(), [
            'attachment' => 'required|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'date' => 'required',
            'room' => 'required',
            'visitor' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.hotel.hotel.pengunjung', $id)->with('error', 'Gagal menambahkan data pengunjung')->withInput()->withErrors($validator);
        }
        $hotel = New HotelVisitor();
        $hotel->hotel_id = $id;
        $hotel->date = $request->input('date');
        $hotel->room = $request->input('room');
        $hotel->visitor = $request->input('visitor');
        $hotel->attachment =  $request->file('attachment')->store('pengunjung-hotel', 'public');
        $hotel->save();
        return redirect()->route('admin.hotel.hotel.pengunjung', $id)->with('success', 'Berhasil menambahkan data pengunjung');
    }

    public function hotelVisitorUpdate($id, $idVisitor, Request $request){
        $validator = Validator::make($request->all(), [
            'attachment' => 'nullable|sometimes|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'date' => 'required',
            'room' => 'required',
            'visitor' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.hotel.hotel.pengunjung', $id)->with('error', 'Gagal menambahkan data pengunjung')->withInput()->withErrors($validator);
        }
        $hotel = HotelVisitor::findOrFail($idVisitor);
        $hotel->hotel_id = $id;
        $hotel->date = $request->input('date');
        $hotel->room = $request->input('room');
        $hotel->visitor = $request->input('visitor');
        if($request->has('attachment')){
            $hotel->attachment =  $request->file('attachment')->store('pengunjung-hotel', 'public');
        }
        $hotel->save();
        return redirect()->route('admin.hotel.hotel.pengunjung', $id)->with('success', 'Berhasil menambahkan data pengunjung');
    }

    public function hotelVisitorDestroy($id, $idVisitor){
        $visitor = HotelVisitor::findOrFail($idVisitor);
        $visitor->delete();
        return redirect()->route('admin.hotel.hotel.pengunjung', $id)->with('success','Berhasil menghapus menu');
    }

    public function review(){
        $data = [
            'title' => 'Hotel',
            'subTitle' => 'Review',
            'page_id' => 5,
            'review' => HotelReview::paginate(10)
        ];
        return view('admin.pages.hotel.review',  $data);
    }

    public function reviewDestroy($id){
        $review = HotelReview::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.hotel.review')->with('success','Berhasil menghapus review');
    }

    public function visitor(){
        $data = [
            'title' => 'Hotel',
            'subTitle' => 'Pengunjung',
            'page_id' => 5,
            'visitor' => HotelVisitor::paginate(10)
        ];
        return view('admin.pages.hotel.visitor',  $data);
    }
}
