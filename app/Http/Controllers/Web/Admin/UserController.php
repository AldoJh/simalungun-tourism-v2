<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\User;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Tourism;
use App\Models\EventAdmin;
use App\Models\HotelAdmin;
use App\Models\Restaurant;
use App\Models\TourismAdmin;
use Illuminate\Http\Request;
use App\Models\RestaurantAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function user(){
        $data = [
            'title' => 'Pengguna',
            'subTitle' => null,
            'page_id' => 10,
            'user' => User::where('role', 'superadmin')->orWhere('role', 'admin')->paginate(10)
        ];
        return view('admin.pages.user.user',  $data);
    }

    public function userStore(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.pengguna')->with('error', 'Gagal menambahkan pengguna baru')->withInput()->withErrors($validator);
        }

        $user = New User();
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect()->route('admin.pengguna')->with('success','Berhasil menambahkan pengguna baru');
    }

    public function userUpdate($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        if ($validator->fails()) {
            dd($validator->errors());
            return redirect()->route('admin.pengguna')->with('error', 'Gagal mengubah data pengguna')->withInput()->withErrors($validator);
        }

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');
        $user->email = $request->input('email');
        if($request->input('password')){
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();
        return redirect()->route('admin.pengguna')->with('success','Berhasil mengubah data pengguna');
    }

    public function userDestroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.pengguna')->with('success','Berhasil menghapus data pengguna');
    }

    public function permission($id){
        $data = [
            'title' => 'Pengguna',
            'subTitle' => 'Hak Akses',
            'page_id' => 10,
            'user' => User::findOrFail($id),
            'tourism' => Tourism::all(),
            'hotel' => Hotel::all(),
            'restaurant' => Restaurant::all(),
            'event' => Event::all(),
        ];
        return view('admin.pages.user.permission',  $data);
    }

    public function permissionUpdate($id, Request $request){
        if(is_array($request->tourism)){
            TourismAdmin::where('user_id', $id)->delete();
            foreach ($request->tourism as  $data) {
                TourismAdmin::updateOrInsert([
                    'tourism_id' => $data,
                    'user_id' => $id
                ]);
            }
        }else{
            TourismAdmin::where('user_id', $id)->delete();
        }

        if(is_array($request->hotel)){
            HotelAdmin::where('user_id', $id)->delete();
            foreach ($request->hotel as  $data) {
                HotelAdmin::updateOrInsert([
                    'hotel_id' => $data,
                    'user_id' => $id
                ]);
            }
        }else{
            HotelAdmin::where('user_id', $id)->delete();
        }

        if(is_array($request->restaurant)){
            RestaurantAdmin::where('user_id', $id)->delete();
            foreach ($request->restaurant as  $data) {
                RestaurantAdmin::updateOrInsert([
                    'restaurant_id' => $data,
                    'user_id' => $id
                ]);
            }
        }else{
            RestaurantAdmin::where('user_id', $id)->delete();
        }

        if(is_array($request->event)){
            EventAdmin::where('user_id', $id)->delete();
            foreach ($request->event as  $data) {
                EventAdmin::updateOrInsert([
                    'event_id' => $data,
                    'user_id' => $id
                ]);
            }
        }else{
            EventAdmin::where('user_id', $id)->delete();
        }
        return redirect()->route('admin.pengguna.akses', $id)->with('success','Berhasil merubah hak akses');
    }
}
