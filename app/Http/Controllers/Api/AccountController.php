<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
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
            'name' => 'nullable|sometimes|',
            'email' => [
                'nullable',
                'sometimes',
                'email',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'phone' => [
                'nullable',
                'sometimes',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);    
        $validation = array_fill_keys(array_keys($request->all()), []);    
        if ($validator->fails()) {
            foreach ($validator->errors()->toArray() as $key => $errors) {
                $validation[$key] = $errors;
            }
            return response()->json([
                'response' => Response::HTTP_BAD_REQUEST,
                'success' => false,
                'message' => 'Validation error occurred',
                'validation' => $validation,
                'data' => null
            ], Response::HTTP_BAD_REQUEST);
        }
    
        try {
            $user = User::findOrFail(Auth::user()->id);
            if ($request->hasFile('photo')) {
                $user->photo = $request->file('photo')->store('user', 'public');
            }
            if($request->has('name')){
                $user->name = $request->name;
            }
            if($request->has('email')){
                $user->email = $request->email;
            }
            if($request->has('phone')){
                $user->phone = $request->phone;
            }
            $user->save();
            $data = User::where('id', auth()->user()->id)->get();
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'User account updated successfully',
                'validation' => $validation,
                'data' => UserResource::collection($data)->first()
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
        $validation = array_fill_keys(array_keys($request->all()), []);
        if ($validator->fails()) {
            foreach ($validator->errors()->toArray() as $key => $errors) {
                $validation[$key] = $errors;
            }
            return response()->json([
                'response' => Response::HTTP_BAD_REQUEST,
                'success' => false,
                'message' => 'Validation error occurred',
                'validation' => $validation,
                'data' => null
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Password changed successfully',
                'validation' => $validation,
                'data' => $user
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
