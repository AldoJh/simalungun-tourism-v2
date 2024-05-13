<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\District;
use App\Models\Facility;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\RestaurantReview;
use App\Models\RestaurantVisitor;
use App\Http\Controllers\Controller;
use App\Models\RestaurantFacility;
use App\Models\RestaurantImage;
use Illuminate\Support\Facades\Validator;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;

class RestaurantController extends Controller
{
    public function restaurant(Request $request){
        $search = $request->input('q');
        $data = Restaurant::where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'desc')->paginate(10);
        $data->appends(['q' => $search]);
        $data = [
            'title' => 'Restoran',
            'subTitle' => 'Data Restoran',
            'page_id' => 5,
            'restaurant' => $data
        ];
        return view('admin.pages.restaurant.restaurant',  $data);
    }

    public function restaurantAdd(){
        $data = [
            'title' => 'Restoran',
            'subTitle' => 'Tambah Restoran',
            'page_id' => 5,
            'facility' => Facility::all(),
            'district' => District::all()
        ];
        return view('admin.pages.restaurant.add',  $data);
    }

    public function restaurantStore(Request $request){
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'required|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'owner' => 'required',
            'meta' => 'required',
            'name' => 'required',
            'label' => 'required',
            'phone' => 'required',
            'district' => 'required',
            'village' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'address' => 'required',
            'table' => 'required',
            'chair' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.restaurant.restaurant.add')->with('error', 'Gagal menambahkan festival baru')->withInput()->withErrors($validator);
        }
        $id = UniqueIdGenerator::generate(['table' => 'restaurants', 'length' => 9, 'prefix' => date('ymd')]);
        $imagePath = $request->file('thumbnail')->store('resto', 'public');

        $restaurant = new Restaurant();
        $restaurant->id = $id;
        $restaurant->name =$request->input('name');
        $restaurant->owner = $request->input('owner');
        $restaurant->address = $request->input('address');
        $restaurant->description = $request->input('description');
        $restaurant->excerpt = $request->input('meta');
        $restaurant->image = $imagePath;
        $restaurant->phone = $request->input('phone');
        $restaurant->latitude = $request->input('lat');
        $restaurant->longitude = $request->input('long');
        $restaurant->district_id = $request->input('district');
        $restaurant->village_id = $request->input('village');
        $restaurant->chair = $request->input('chair');
        $restaurant->table = $request->input('table');
        $restaurant->label = $request->input('label');
        if($request->recomended == 'on'){
            $restaurant->is_recomended = true;
        }else{
            $restaurant->is_recomended = false;
        }
        $restaurant->save();

        $image = New RestaurantImage();
        $image->restaurant_id = $id;
        $image->image = $imagePath;
        $image->save();

        
        if(is_array($request->facility)){
            foreach ($request->facility as  $data) {
                RestaurantFacility::updateOrInsert([
                    'restaurant_id' => $id,
                    'facility_id' => $data
                ]);
            }
        }
        return redirect()->route('admin.restoran.restoran.pengunjung', $id)->with('success','Berhasil menambahkan restoran');
    }

    public function restaurantEdit($id){
        $data = [
            'title' => 'Restoran',
            'subTitle' => 'Edit Restoran',
            'page_id' => 5,
            'facility' => Facility::all(),
            'district' => District::all(),
            'restaurant' => Restaurant::findOrFail($id)
        ];
        return view('admin.pages.restaurant.edit',  $data);
    }

    public function restaurantUpdate($id, Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'nullable|sometimes|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'owner' => 'required',
            'meta' => 'required',
            'name' => 'required',
            'label' => 'required',
            'phone' => 'required',
            'district' => 'required',
            'village' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'address' => 'required',
            'table' => 'required',
            'chair' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.restaurant.restaurant.edit', $id)->with('error', 'Gagal validasi error')->withInput()->withErrors($validator);
        }

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->name =$request->input('name');
        $restaurant->owner = $request->input('owner');
        $restaurant->address = $request->input('address');
        $restaurant->description = $request->input('description');
        $restaurant->excerpt = $request->input('meta');
        if($request->has('thumbnail')){
            $restaurant->image = $request->file('thumbnail')->store('resto', 'public');
        }
        $restaurant->phone = $request->input('phone');
        $restaurant->latitude = $request->input('lat');
        $restaurant->longitude = $request->input('long');
        $restaurant->district_id = $request->input('district');
        $restaurant->village_id = $request->input('village');
        $restaurant->chair = $request->input('chair');
        $restaurant->table = $request->input('table');
        $restaurant->label = $request->input('label');
        if($request->recomended == 'on'){
            $restaurant->is_recomended = 1;
        }else{
            $restaurant->is_recomended = 0;
        }
        $restaurant->save();
        if(is_array($request->facility)){
            RestaurantFacility::where('restaurant_id', $id)->delete();
            foreach ($request->facility as  $data) {
                RestaurantFacility::updateOrInsert([
                    'restaurant_id' => $id,
                    'facility_id' => $data
                ]);
            }
        }else{
            RestaurantFacility::where('restaurant_id', $id)->delete();
        }
        return redirect()->route('admin.restoran.restoran.pengunjung', $id)->with('success','Berhasil menambahkan restoran');
    }

    public function restaurantDestroy($id){
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();
        return redirect()->route('admin.restoran.restoran')->with('success','Berhasil menghapus restoran');
    }

    public function review(){
        $data = [
            'title' => 'Restoran',
            'subTitle' => 'Review',
            'page_id' => 5,
            'review' => RestaurantReview::paginate(10)
        ];
        return view('admin.pages.restaurant.review',  $data);
    }

    public function reviewDestroy($id){
        $review = RestaurantReview::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.restoran.review')->with('success','Berhasil menghapus review');
    }

    public function visitor(){
        $data = [
            'title' => 'Restoran',
            'subTitle' => 'Pengunjung',
            'page_id' => 5,
            'visitor' => RestaurantVisitor::paginate(10)
        ];
        return view('admin.pages.restaurant.visitor',  $data);
    }
}


