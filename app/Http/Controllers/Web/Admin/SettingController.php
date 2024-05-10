<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function setting(){
        $data = [
            'title' => 'Pengaturan',
            'subTitle' => null,
            'page_id' => 11,
            'setting' => Setting::find(1)
        ];
        return view('admin.pages.setting.setting',  $data);
    }

    public function settingUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'siteName' => 'required',
            'description' => 'required',
            'email' => 'required',
            'playstore' => 'required',
            'whatsapp' => 'required',
            'instagram' => 'required',
            'facebook' => 'required',
        ]);
        if ($validator->fails()) {
        return redirect()->route('admin.pengaturan')->with('error', 'Validation Error')->withInput()->withErrors($validator);
        }

        $setting =  Setting::find(1);
        $setting->site_name = $request->input('siteName');
        $setting->description = $request->input('description');
        $setting->email = $request->input('email');
        $setting->playstore = $request->input('playstore');
        $setting->whatsapp = $request->input('whatsapp');
        $setting->instagram = $request->input('instagram');
        $setting->facebook = $request->input('facebook');
        $setting->save();

        return redirect()->route('admin.pengaturan')->with('success', 'Berhasil merubah pengaturan');
    }
}
