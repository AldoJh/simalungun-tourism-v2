<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|numeric|min:10|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'response' => Response::HTTP_BAD_REQUEST,
                'success' => false,
                'message' => $validator->errors()->all(),
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $user = new User();
            $user->name  = $request->name;
            $user->email  = $request->email;
            $user->password  = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->is_active = true;
            $user->save();

            $token = $user->createToken('auth_token')->plainTextToken;
            Mail::send('email.registerMail', ['email' => $request->email], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Registrasi Berhasil');
            });

            return response()->json([
                'response' => Response::HTTP_CREATED,
                'success' => true,
                'message' => 'Account created successfully',
                'data' => [
                    'data' => $user,
                    'access_token' => $token,
                    'token_type' => 'Bearer'
                ]
            ], Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'response' => Response::HTTP_BAD_REQUEST,
                'success' => false,
                'message' => $validator->errors()->all(),
            ], Response::HTTP_BAD_REQUEST);
        }
        
        try {
            if (! $token = auth()->attempt($request->all())) {
                return response()->json([
                    'response' => Response::HTTP_UNAUTHORIZED,
                    'success' => false,
                    'message' => 'Username or password wrong',
                ], Response::HTTP_UNAUTHORIZED);
            }
            $user = User::where('email', $request->email)->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Account login successfully',
                'data' => [
                    'data' => $user,
                    'access_token' => $token,
                    'token_type' => 'Bearer'
                ]
            ], Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }   
    }

    public function forget(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'response' => Response::HTTP_BAD_REQUEST,
                'success' => false,
                'message' => $validator->errors()->all(),
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $token = Uuid::uuid4();
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email, 
                'token' => $token, 
            ]); 
            Mail::send('email.forgetPassword', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'email sent successfully',
            ], Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'response' => Response::HTTP_OK,
            'success' => true,
            'message' => 'Account logged out successfully',
        ], Response::HTTP_OK);
    }
}
