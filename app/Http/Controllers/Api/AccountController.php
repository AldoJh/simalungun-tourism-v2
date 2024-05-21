<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function me()
    {
        $data = User::where('id', auth()->user()->id)->get();
        return response()->json([
            'response' => Response::HTTP_OK,
            'success' => true,
            'message' => 'User recent retrived',
            'data' => UserResource::collection($data)->first()
        ], Response::HTTP_OK);
    }

    public function update(Request $request)
    {    
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response' => Response::HTTP_BAD_REQUEST,
                'success' => false,
                'message' => $validator->errors()->all(),
            ], Response::HTTP_BAD_REQUEST);
        }
        try {
            $user = User::findOrFail(Auth::user()->id);
            if($request->hasFile('photo')){
                $user->photo =  $request->file('photo')->store('user', 'public');
            }
            $user->name  = $request->name;
            $user->email  = $request->email;
            $user->save();
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'User account update with photo successfully',
                'data' => $request->all()
            ], Response::HTTP_OK);
            
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function password_change(Request $request)
    {    
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
            'passwordConfirmation' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response' => Response::HTTP_BAD_REQUEST,
                'success' => false,
                'message' => $validator->errors()->all(),
            ], Response::HTTP_BAD_REQUEST);
        }
        try {
            $user = User::findOrFail(Auth::user()->id);
            $user->password  = Hash::make($request->password);
            $user->save();
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Change password successfully',
                'data' => $request->all()
            ], Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
