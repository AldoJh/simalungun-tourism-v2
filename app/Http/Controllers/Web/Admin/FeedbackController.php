<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function feedback(){
        $data = [
            'title' => 'Kuisioner',
            'subTitle' => null,
            'page_id' => 8,
            'feedback' => Feedback::all()
        ];
        return view('admin.pages.feedback.feedback',  $data);
    }

    public function feedbackDestroy($id){
        $feedback = Feedback::find($id);
        $feedback->delete();
        return redirect()->route('admin.kuisioner')->with('success','Berhasil menghapus tanggapan');
    }
}
