<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\HotelCategory;
use App\Models\TourismCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MasterDataController extends Controller
{
    public function facility(){
        $data = [
            'title' => 'Data Master',
            'subTitle' => 'Fasilitas',
            'page_id' => 1,
            'fasilitas' => Facility::all()
        ];
        return view('admin.pages.master-data.facility',  $data);
    }

    public function facilityStore(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.data-master.fasilitas')->with('error', 'Gagal menambahkan fasilitas baru')->withInput()->withErrors($validator);
        }

        $fasilitas = New Facility();
        $fasilitas->name = $request->input('name');
        $fasilitas->save();
        return redirect()->route('admin.data-master.fasilitas')->with('success','Berhasil menambahkan fasilitas baru');
    }

    public function facilityUpdate($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.data-master.fasilitas')->with('error', 'Gagal mengubah data fasilitas')->withInput()->withErrors($validator);
        }
        $fasilitas = Facility::findOrFail($id);
        $fasilitas->name = $request->input('name');
        $fasilitas->save();
        return redirect()->route('admin.data-master.fasilitas')->with('success','Berhasil mengubah data fasilitas');
    }

    public function facilityDestroy($id){
        $fasilitas = Facility::find($id);
        $fasilitas->delete();
        return redirect()->route('admin.data-master.fasilitas')->with('success','Berhasil menghapus data fasilitas');
    }

    public function tourismCategory(){
        $data = [
            'title' => 'Data Master',
            'subTitle' => 'Kategori Wisata',
            'page_id' => 1,
            'category' => TourismCategory::all()
        ];
        return view('admin.pages.master-data.tourism_category',  $data);
    }

    public function tourismCategoryStore(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.data-master.kategori-wisata')->with('error', 'Gagal menambahkan kategori baru')->withInput()->withErrors($validator);
        }

        $category = New TourismCategory();
        $category->name = $request->input('name');
        $category->save();
        return redirect()->route('admin.data-master.kategori-wisata')->with('success','Berhasil menambahkan kategori baru');
    }

    public function tourismCategoryUpdate($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.data-master.kategori-wisata')->with('error', 'Gagal mengubah data kategori')->withInput()->withErrors($validator);
        }
        $category = TourismCategory::findOrFail($id);
        $category->name = $request->input('name');
        $category->save();
        return redirect()->route('admin.data-master.kategori-wisata')->with('success','Berhasil mengubah data kategori');
    }

    public function tourismCategoryDestroy($id){
        $category = TourismCategory::find($id);
        $category->delete();
        return redirect()->route('admin.data-master.kategori-wisata')->with('success','Berhasil menghapus data kategori');
    }

    public function hotelCategory(){
        $data = [
            'title' => 'Data Master',
            'subTitle' => 'Kategori Hotel',
            'page_id' => 1,
            'category' => HotelCategory::all()
        ];
        return view('admin.pages.master-data.hotel_category',  $data);
    }

    public function hotelCategoryStore(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.data-master.kategori-hotel')->with('error', 'Gagal menambahkan kategori baru')->withInput()->withErrors($validator);
        }

        $category = New HotelCategory();
        $category->name = $request->input('name');
        $category->save();
        return redirect()->route('admin.data-master.kategori-hotel')->with('success','Berhasil menambahkan kategori baru');
    }

    public function hotelCategoryUpdate($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.data-master.kategori-hotel')->with('error', 'Gagal mengubah data kategori')->withInput()->withErrors($validator);
        }
        $category = HotelCategory::findOrFail($id);
        $category->name = $request->input('name');
        $category->save();
        return redirect()->route('admin.data-master.kategori-hotel')->with('success','Berhasil mengubah data kategori');
    }

    public function hotelCategoryDestroy($id){
        $category = HotelCategory::find($id);
        $category->delete();
        return redirect()->route('admin.data-master.kategori-hotel')->with('success','Berhasil menghapus data kategori');
    }

}
