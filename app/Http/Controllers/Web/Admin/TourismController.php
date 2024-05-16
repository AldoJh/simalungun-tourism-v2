<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Tourism;
use App\Models\District;
use App\Models\Facility;
use App\Models\TourismAdmin;
use App\Models\TourismGuide;
use App\Models\TourismImage;
use Illuminate\Http\Request;
use App\Models\TourismReview;
use App\Models\TourismVisitor;
use App\Models\TourismCategory;
use App\Models\TourismFacility;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;

class TourismController extends Controller
{
    public function tourism(Request $request){
        $search = $request->input('q');
        $data = Tourism::where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'asc')->paginate(10);
        $data->appends(['q' => $search]);
        $data = [
            'title' => 'Wisata',
            'subTitle' => 'Data Wisata',
            'page_id' => 4,
            'tourism' => $data
        ];
        return view('admin.pages.tourism.tourism',  $data);
    }

    public function tourismAdd(){
        $data = [
            'title' => 'Wisata',
            'subTitle' => 'Tambah Wisata',
            'page_id' => 5,
            'facility' => Facility::all(),
            'district' => District::all(),
            'category' => TourismCategory::all()
        ];
        return view('admin.pages.tourism.add',  $data);
    }

    public function tourismStore(Request $request){
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'required|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'meta' => 'required',
            'name' => 'required',
            'category' => 'required',
            'phone' => 'required',
            'district' => 'required',
            'village' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'address' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.wisata.wisata.add')->with('error', 'Gagal menambahkan wisata baru')->withInput()->withErrors($validator);
        }
        $id = UniqueIdGenerator::generate(['table' => 'restaurants', 'length' => 9, 'prefix' => date('ymd')]);
        $imagePath = $request->file('thumbnail')->store('resto', 'public');

        $restaurant = new Tourism();
        $restaurant->id = $id;
        $restaurant->name =$request->input('name');
        $restaurant->address = $request->input('address');
        $restaurant->description = $request->input('description');
        $restaurant->excerpt = $request->input('meta');
        $restaurant->image = $imagePath;
        $restaurant->phone = $request->input('phone');
        $restaurant->latitude = $request->input('lat');
        $restaurant->longitude = $request->input('long');
        $restaurant->district_id = $request->input('district');
        $restaurant->village_id = $request->input('village');
        $restaurant->category_id = $request->input('category');
        if($request->recomended == 'on'){
            $restaurant->is_recomended = true;
        }else{
            $restaurant->is_recomended = false;
        }
        $restaurant->save();

        $image = New TourismImage();
        $image->tourism_id = $id;
        $image->image = $imagePath;
        $image->save();

        
        if(is_array($request->facility)){
            foreach ($request->facility as  $data) {
                TourismFacility::updateOrInsert([
                    'tourism_id' => $id,
                    'facility_id' => $data
                ]);
            }
        }
        return redirect()->route('admin.wisata.wisata.pengunjung', $id)->with('success','Berhasil menambahkan wisata');
    }

    public function review(){
        $data = [
            'title' => 'Wisata',
            'subTitle' => 'Review',
            'page_id' => 5,
            'review' => TourismReview::paginate(10)
        ];
        return view('admin.pages.tourism.review',  $data);
    }

    public function tourismVisitor($id){
        $tourism = Tourism::findOrFail($id);
        $data = [
            'title' => 'Wisata',
            'subTitle' => $tourism->slug,
            'page_id' => 4,
            'tourism' => $tourism,
            'visitor' => TourismVisitor::where('tourism_id', $id)->paginate(10),
        ];
        return view('admin.pages.tourism.tourism_visitor',  $data);
    }

    public function tourismVisitorStore($id, Request $request){
        $validator = Validator::make($request->all(), [
            'attachment' => 'required|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'date' => 'required',
            'visitor' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.wisata.wisata.pengunjung', $id)->with('error', 'Gagal menambahkan data pengunjung')->withInput()->withErrors($validator);
        }
        $visitor = New TourismVisitor();
        $visitor->tourism_id = $id;
        $visitor->date = $request->input('date');
        $visitor->visitor = $request->input('visitor');
        $visitor->attachment =  $request->file('attachment')->store('pengunjung-wisata', 'public');
        $visitor->save();
        return redirect()->route('admin.wisata.wisata.pengunjung', $id)->with('success', 'Berhasil menambahkan data pengunjung');
    }

    public function tourismVisitorUpdate($id, $idVisitor, Request $request){
        $validator = Validator::make($request->all(), [
            'attachment' => 'nullable|sometimes|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'date' => 'required',
            'visitor' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.wisata.wisata.pengunjung', $id)->with('error', 'Gagal menambahkan data pengunjung')->withInput()->withErrors($validator);
        }
        $visitor = TourismVisitor::findOrFail($idVisitor);
        $visitor->tourism_id = $id;
        $visitor->date = $request->input('date');
        $visitor->visitor = $request->input('visitor');
        if($request->has('attachment')){
            $visitor->attachment =  $request->file('attachment')->store('pengunjung-wisata', 'public');
        }
        $visitor->save();
        return redirect()->route('admin.wisata.wisata.pengunjung', $id)->with('success', 'Berhasil menambahkan data pengunjung');
    }

    public function tourismVisitorDestroy($id, $idVisitor){
        $visitor = TourismVisitor::findOrFail($idVisitor);
        $visitor->delete();
        return redirect()->route('admin.wisata.wisata.pengunjung', $id)->with('success','Berhasil menghapus review');
    }

    public function tourismReview($id){
        $tourism = Tourism::findOrFail($id);
        $data = [
            'title' => 'Wisata',
            'subTitle' => $tourism->slug,
            'page_id' => 4,
            'tourism' => $tourism,
            'review' => TourismReview::where('tourism_id', $id)->paginate(10),
        ];
        return view('admin.pages.tourism.tourism_review',  $data);
    }

    public function tourismGuide($id){
        $tourism = Tourism::findOrFail($id);
        $data = [
            'title' => 'Wisata',
            'subTitle' => $tourism->slug,
            'page_id' => 4,
            'tourism' => $tourism,
            'guide' => TourismGuide::where('tourism_id', $id)->paginate(10),
        ];
        return view('admin.pages.tourism.tourism_guide',  $data);
    }

    public function tourismGuideStore($id, Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'name' => 'required',
            'gender' => 'required',
            'birthdate' => 'required',
            'country' => 'required',
            'religion' => 'required',
            'phone' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.wisata.wisata.pemandu', $id)->with('error', 'Gagal menambah data pemandu wisata')->withInput()->withErrors($validator);
        }
        $menu = new TourismGuide();
        $menu->tourism_id = $id;
        $menu->name = $request->input('name');
        $menu->gender = $request->input('gender');
        $menu->birthdate = $request->input('birthdate');
        $menu->country = $request->input('country');
        $menu->religion = $request->input('religion');
        $menu->phone = $request->input('phone');
        $menu->image =  $request->file('image')->store('tourism-place/guide', 'public');
        $menu->save();
        return redirect()->route('admin.wisata.wisata.pemandu', $id)->with('success', 'Berhasil menambah data pemandu wisata');
    }

    public function tourismGuideUpdate($id, $idGuide, Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|sometimes|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'name' => 'required',
            'gender' => 'required',
            'birthdate' => 'required',
            'country' => 'required',
            'religion' => 'required',
            'phone' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.wisata.wisata.pemandu', $id)->with('error', 'Gagal mengubah data pemandu wisata')->withInput()->withErrors($validator);
        }
        $menu = TourismGuide::findOrFail($idGuide);
        $menu->tourism_id = $id;
        $menu->name = $request->input('name');
        $menu->gender = $request->input('gender');
        $menu->birthdate = $request->input('birthdate');
        $menu->country = $request->input('country');
        $menu->religion = $request->input('religion');
        $menu->phone = $request->input('phone');
        if($request->has('image')){
            $menu->image =  $request->file('image')->store('tourism-place/guide', 'public');
        }
        $menu->save();
        return redirect()->route('admin.wisata.wisata.pemandu', $id)->with('success', 'Berhasil mengubah data pemandu wisata');
    }

    public function tourismGuideDestroy($id, $idGuide){
        $guide = TourismGuide::findOrFail($idGuide);
        $guide->delete();
        return redirect()->route('admin.wisata.wisata.pemandu', $id)->with('success','Berhasil menghapus data pemandu wisata');
    }

    public function tourismGallery($id){
        $tourism = Tourism::findOrFail($id);
        $data = [
            'title' => 'Wisata',
            'subTitle' => $tourism->slug,
            'page_id' => 4,
            'tourism' => $tourism,
            'gallery' => TourismImage::where('tourism_id', $id)->get(),
        ];
        return view('admin.pages.tourism.tourism_gallery',  $data);
    }

    public function tourismGalleryStore($id, Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,bmp,png,jpg,svg|max:5000',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.wisata.wisata.galeri', $id)->with('error', 'Gagal menambahkan gambar')->withInput()->withErrors($validator);
        }
        $image = New tourismImage();
        $image->tourism_id = $id;
        $image->image = $request->file('image')->store('tourism-place/collection', 'public');
        $image->save();
        return redirect()->route('admin.wisata.wisata.galeri', $id)->with('success', 'Berhasil menambahkan gambar');
    }

    public function tourismAdmin($id){
        $tourism = Tourism::findOrFail($id);
        $data = [
            'title' => 'Wisata',
            'subTitle' => $tourism->slug,
            'page_id' => 4,
            'tourism' => $tourism,
            'admin' => TourismAdmin::where('tourism_id', $id)->get(),
        ];
        return view('admin.pages.tourism.tourism_admin',  $data);
    }

    public function tourismGalleryDestroy($id, $idGallery){
        $image = tourismImage::findOrFail($idGallery);
        $image->delete();
        return redirect()->route('admin.wisata.wisata.galeri', $id)->with('success','Berhasil menghapus gambar');
    }

    public function reviewDestroy($id, $idVisitor){
        $review = TourismReview::findOrFail($idVisitor);
        $review->delete();
        return redirect()->route('admin.wisata.wisata.pengunjung', $id)->with('success','Berhasil menghapus review');
    }

    public function visitor(){
        $data = [
            'title' => 'Wisata',
            'subTitle' => 'Pengunjung',
            'page_id' => 5,
            'visitor' => TourismVisitor::paginate(10)
        ];
        return view('admin.pages.tourism.visitor',  $data);
    }
}
