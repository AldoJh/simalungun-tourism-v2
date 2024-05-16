<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Hotel;
use App\Models\District;
use App\Models\Facility;
use App\Models\HotelAdmin;
use App\Models\HotelImage;
use App\Models\HotelReview;
use App\Models\HotelVisitor;
use Illuminate\Http\Request;
use App\Models\HotelCategory;
use App\Models\HotelFacility;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;

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

    public function hotelAdd(){
        $data = [
            'title' => 'Hotel',
            'subTitle' => 'Tambah Hotel',
            'page_id' => 5,
            'facility' => Facility::all(),
            'district' => District::all(),
            'category' => HotelCategory::all()
        ];
        return view('admin.pages.hotel.add',  $data);
    }

    public function hotelStore(Request $request){
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'required|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'owner' => 'required',
            'meta' => 'required',
            'name' => 'required',
            'category' => 'required',
            'phone' => 'required',
            'district' => 'required',
            'village' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'address' => 'required',
            'room' => 'required',
            'min' => 'required',
            'max' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.hotel.hotel.add')->with('error', 'Gagal menambahkan hotel baru')->withInput()->withErrors($validator);
        }
        $id = UniqueIdGenerator::generate(['table' => 'hotels', 'length' => 9, 'prefix' => date('ymd')]);
        $imagePath = $request->file('thumbnail')->store('hotel', 'public');

        $hotel = new Hotel();
        $hotel->id = $id;
        $hotel->name =$request->input('name');
        $hotel->owner = $request->input('owner');
        $hotel->address = $request->input('address');
        $hotel->description = $request->input('description');
        $hotel->excerpt = $request->input('meta');
        $hotel->image = $imagePath;
        $hotel->phone = $request->input('phone');
        $hotel->latitude = $request->input('lat');
        $hotel->longitude = $request->input('long');
        $hotel->district_id = $request->input('district');
        $hotel->village_id = $request->input('village');
        $hotel->room = $request->input('room');
        $hotel->min_price = $request->input('min');
        $hotel->max_price = $request->input('max');
        $hotel->category_id = $request->input('category');
        if($request->verified == 'on'){
            $hotel->is_verified = true;
        }else{
            $hotel->is_verified = false;
        }
        $hotel->save();

        $image = New HotelImage();
        $image->hotel_id = $id;
        $image->image = $imagePath;
        $image->save();

        
        if(is_array($request->facility)){
            foreach ($request->facility as  $data) {
                HotelFacility::updateOrInsert([
                    'hotel_id' => $id,
                    'facility_id' => $data
                ]);
            }
        }
        return redirect()->route('admin.hotel.hotel.pengunjung', $id)->with('success','Berhasil menambahkan hotel');
    }

    public function hotelEdit($id){
        $data = [
            'title' => 'Hotel',
            'subTitle' => 'Edit Hotel',
            'page_id' => 5,
            'facility' => Facility::all(),
            'district' => District::all(),
            'hotel' => Hotel::findOrFail($id),
            'category' => HotelCategory::all()
        ];
        return view('admin.pages.hotel.edit',  $data);
    }

    public function hotelUpdate($id, Request $request){
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'nullable|sometimes|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'owner' => 'required',
            'meta' => 'required',
            'name' => 'required',
            'category' => 'required',
            'phone' => 'required',
            'district' => 'required',
            'village' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'address' => 'required',
            'room' => 'required',
            'min' => 'required',
            'max' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.hotel.hotel.edit', $id)->with('error', 'Gagal merubah data hotel')->withInput()->withErrors($validator);
        }

        $hotel = Hotel::findOrFail($id);
        $hotel->name =$request->input('name');
        $hotel->owner = $request->input('owner');
        $hotel->address = $request->input('address');
        $hotel->description = $request->input('description');
        $hotel->excerpt = $request->input('meta');
        if($request->has('thumbnail')){
            $hotel->image = $request->file('thumbnail')->store('hotel', 'public');
        }
        $hotel->phone = $request->input('phone');
        $hotel->latitude = $request->input('lat');
        $hotel->longitude = $request->input('long');
        $hotel->district_id = $request->input('district');
        $hotel->village_id = $request->input('village');
        $hotel->room = $request->input('room');
        $hotel->min_price = $request->input('min');
        $hotel->max_price = $request->input('max');
        $hotel->category_id = $request->input('category');
        if($request->verified == 'on'){
            $hotel->is_verified = true;
        }else{
            $hotel->is_verified = false;
        }
        $hotel->save();
        
        if(is_array($request->facility)){
            HotelFacility::where('hotel_id', $id)->delete();
            foreach ($request->facility as  $data) {
                HotelFacility::updateOrInsert([
                    'hotel_id' => $id,
                    'facility_id' => $data
                ]);
            }
        }else{
            HotelFacility::where('hotel_id', $id)->delete();
        }
        return redirect()->route('admin.hotel.hotel.pengunjung', $id)->with('success','Berhasil menambahkan hotel');
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

    public function hotelReview($id){
        $hotel = Hotel::findOrFail($id);
        $data = [
            'title' => 'Hotel',
            'subTitle' => $hotel->slug,
            'page_id' => 5,
            'hotel' => $hotel,
            'review' => hotelReview::where('hotel_id', $id)->paginate(10),
        ];
        return view('admin.pages.hotel.hotel_review',  $data);
    }

    public function hotelGallery($id){
        $hotel = Hotel::findOrFail($id);
        $data = [
            'title' => 'Hotel',
            'subTitle' => $hotel->slug,
            'page_id' => 5,
            'hotel' => $hotel,
            'gallery' => HotelImage::where('hotel_id', $id)->get(),
        ];
        return view('admin.pages.hotel.hotel_gallery',  $data);
    }

    public function hotelGalleryStore($id, Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,bmp,png,jpg,svg|max:5000',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.hotel.hotel.galeri', $id)->with('error', 'Gagal menambahkan gambar')->withInput()->withErrors($validator);
        }
        $image = New hotelImage();
        $image->hotel_id = $id;
        $image->image = $request->file('image')->store('hotel/collection', 'public');
        $image->save();
        return redirect()->route('admin.hotel.hotel.galeri', $id)->with('success', 'Berhasil menambahkan gambar');
    }

    public function hotelGalleryDestroy($id, $idGallery){
        $image = HotelImage::findOrFail($idGallery);
        $image->delete();
        return redirect()->route('admin.hotel.hotel.galeri', $id)->with('success','Berhasil menghapus gambar');
    }

    public function hotelAdmin($id){
        $hotel = Hotel::findOrFail($id);
        $data = [
            'title' => 'Hotel',
            'subTitle' => $hotel->slug,
            'page_id' => 5,
            'hotel' => $hotel,
            'admin' => HotelAdmin::where('hotel_id', $id)->get(),
        ];
        return view('admin.pages.hotel.hotel_admin',  $data);
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
