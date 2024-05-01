<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
