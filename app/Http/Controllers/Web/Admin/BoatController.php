<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Boat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BoatController extends Controller
{
    public function boat(){
        $data = [
            'title' => 'Kapal',
            'subTitle' => null,
            'page_id' => 7,
            'boats' => Boat::paginate(10)
        ];
        return view('admin.pages.boat.boat',  $data);
    }

    public function boatStore(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'owner' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'route' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.kapal')->with('error', 'Gagal menambahkan data kapal baru')->withInput()->withErrors($validator);
        }

        $boats = New Boat();
        $boats->name = $request->input('name');
        $boats->owner = $request->input('owner');
        $boats->address = $request->input('address');
        $boats->phone = $request->input('phone');
        $boats->route = $request->input('route');
        $boats->updated_by = Auth::user()->email;
        $boats->save();
        return redirect()->route('admin.kapal')->with('success','Berhasil menambahkan data kapal baru');
    }

    public function boatUpdate($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'owner' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'route' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.kapal')->with('error', 'Gagal merubah data kapal')->withInput()->withErrors($validator);
        }
        $boats = Boat::findOrFail($id);
        $boats->name = $request->input('name');
        $boats->owner = $request->input('owner');
        $boats->address = $request->input('address');
        $boats->phone = $request->input('phone');
        $boats->route = $request->input('route');
        $boats->updated_by = Auth::user()->email;
        $boats->save();
        return redirect()->route('admin.kapal')->with('success','Berhasil merubah data kapal');
    }
    
    public function boatDestroy($id){
        $boats = Boat::find($id);
        $boats->delete();
        return redirect()->route('admin.kapal')->with('success','Berhasil menghapus data kapal');
    }
}
