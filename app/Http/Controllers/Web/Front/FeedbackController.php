<?php

namespace App\Http\Controllers\Web\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Kuisioner',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('front.pages.feedback.index',  $data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric|min:10',
            'age' => 'required|string',
            'feedback' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->route('kuisioner')->withInput()->withErrors($validator);
        }
        $user = new Feedback();
        $user->name  = $request->name;
        $user->email  = $request->email;
        $user->phone  = $request->phone;
        $user->age = $request->age;
        $user->answer = $request->feedback;
        $user->suggestion = $request->comment;
        $user->save();
        return redirect()->route('kuisioner')->with('success', 'Thank  for your feedback');
    }
}
