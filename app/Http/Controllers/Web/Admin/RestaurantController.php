<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
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
}
