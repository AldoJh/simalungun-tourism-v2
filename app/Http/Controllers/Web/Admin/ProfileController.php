<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile(){
        $data = [
            'title' => 'Profil',
            'subTitle' => null,
            'page_id' => 12,
        ];
        return view('admin.pages.profile.profile',  $data);
    }

    public function profileUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|sometimes|image|mimes:jpeg,bmp,png,jpg,svg|max:2000',
            'name' => 'sometimes|required',
            'phoneNumber' => 'sometimes|required',
        ]);
        if ($validator->fails()) {
        return redirect()->route('admin.profil')->with('error', 'Validation Error')->withInput()->withErrors($validator);
        }

        $profile =  User::find(Auth::user()->id);
        $profile->name = $request->input('name');
        $profile->phone = $request->input('phone');
        if($request->hasFile('image')){
            $profile->photo =  $request->file('image')->store('user', 'public');
        }
        $profile->save();

        return redirect()->route('admin.profil')->with('success', 'Berhasil merubah profil');
    }

    public function changePassword(Request $request){
        $user = Auth::user();
        $oldPassword = $request->input('oldPassword');
    
        if (!Hash::check($oldPassword, $user->password)) {
            return redirect()->route('admin.profil')->with('error', 'Password lama salah');
        }
        
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|string|min:8',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('admin.profil')->with('error', 'Validation Error')->withErrors($validator);
        }
    
        $userSave = User::findOrFail($user->id);
        $userSave->password = Hash::make($request->input('newPassword'));
        $userSave->save();
    
        return redirect()->route('admin.profil')->with('success', 'Berhasil merubah password');
    }
}
