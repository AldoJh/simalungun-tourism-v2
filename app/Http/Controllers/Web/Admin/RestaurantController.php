<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Facility;
use App\Models\Restaurant;
use Illuminate\Http\Request;

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
        return redirect()->back()->withInput();
        // dd($request->all());

    }
}


