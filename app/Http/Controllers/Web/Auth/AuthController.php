<?php

namespace App\Http\Controllers\Web\Auth;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        $data = [
            'title' => 'Login',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('front.auth.login',  $data);
    }

    public function loginSubmit(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->route('login')->withInput()->withErrors($validator);
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->is_active) {
                if($user->role == 'user'){
                    if($request->route){
                        return redirect($request->route);
                    }else{
                        return redirect()->route('home');
                    }
                }else{
                    return redirect()->route('dashboard');
                }
            } else{
                Auth::logout();
                return redirect()->route('login')->with('warning', 'Your account has been deactivated');
            }
        } else {
            return redirect()->route('login')->with('error', 'Username and password are incorrect, please try again');
        }
    }

    public function register(){
        $data = [
            'title' => 'Register',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('front.auth.register',  $data);
    }

    public function registerSubmit(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|numeric|min:10|unique:users',
        ]);
        if ($validator->fails()) {
            return redirect()->route('register')->withInput()->withErrors($validator);
        }
        $user = new User();
        $user->name  = $request->name;
        $user->email  = $request->email;
        $user->password  = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->is_active = true;
        $user->save();

        Mail::send('email.registerMail', ['email' => $request->email], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Registrasi Berhasil');
        });

        return redirect()->route('login')->with('success', 'Your account registered successfully');
    }

    public function forget(){
        $data = [
            'title' => 'Forget Password',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('front.auth.forget',  $data);
    }

    public function forgetSubmit(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:users',
        ]);
        if ($validator->fails()) {
            return redirect()->route('forget')->withInput()->withErrors($validator);
        }
        $token = Uuid::uuid4();
                DB::table('password_reset_tokens')->insert([
                    'email' => $request->email, 
                    'token' => $token, 
                ]); 
        Mail::send('email.forgetPassword', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return redirect()->route('forget')->with('success', 'Please check your email for password reset');
    }

    public function reset($token){
        $cekToken = DB::table('password_reset_tokens')->where('token', '=', $token)->first();
        if (!$cekToken) {
            return redirect()->route('login')->with('error', 'Invalid token');
        }
        $data = [
            'user' => User::where('email', $cekToken->email)->firstOrFail(),
            'token' => $token,
            'title' => 'Reset Password',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('front.auth.reset',  $data);
    }

    public function resetSubmit($token, Request $request){
        $updatePassword = DB::table('password_reset_tokens')->where(['email' => $request->email,'token' => $token])->first();
        if(!$updatePassword){
            return redirect()->route('login')->with('error','Token Invalid');
        }
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return redirect()->route('reset', $token)->withInput()->withErrors($validator);
        }
        User::where('email', $updatePassword ->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();
        return redirect()->route('login')->with('success','Password changed successfully');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

}
