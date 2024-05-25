<?php

namespace App\Http\Controllers\Api;

use App\Models\Hotel;
use App\Models\HotelReview;
use App\Models\HotelViewer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\HotelResource;
use App\Http\Resources\ReviewResource;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index(Request $request){
        try {
            $keyword = $request->input('q');
            $perPage = $request->input('perPage', 10);            
            $data = Hotel::where('name', 'like', "%$keyword%")->orderBy('is_verified', 'desc')->paginate($perPage);
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Hotel retrieved successfully',
                'meta' => [
                    'query' => $keyword,
                    'path' => $data->path(),
                    'total' => $data->total(),                
                    'perPage' => $data->perPage(),
                    'currentPage' => $data->currentPage(),
                    'lastPage' => $data->lastPage(),
                    'from' => $data->firstItem(),
                    'to' => $data->lastItem(),
                    'hasNext' => $data->hasMorePages(),
                    'hasPrevious' => $data->currentPage() > 1,
                ],
                'data' => HotelResource::collection($data),
            ], Response::HTTP_OK);
            
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id){
        try {
            $data = Hotel::where('id', $id)->get();

            $viewer = New HotelViewer();
            $viewer->hotel_id = $id;
            $viewer->user_id = Auth::user()->id ?? null;
            $viewer->save();

            if (!$data) {
                return response()->json([
                    'response' => Response::HTTP_NOT_FOUND,
                    'success' => false,
                    'message' => 'Hotel not found',
                ], Response::HTTP_NOT_FOUND);
            }
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Hotel show retrieved successfully',
                'data' => HotelResource::collection($data)->first()
            ], Response::HTTP_OK);
            
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function review($id){
        try {
            $data = HotelReview::where('hotel_id', $id)->get();
            if (!$data) {
                return response()->json([
                    'response' => Response::HTTP_NOT_FOUND,
                    'success' => false,
                    'message' => 'Review not found',
                ], Response::HTTP_NOT_FOUND);
            }
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Review retrieved successfully',
                'data' => ReviewResource::collection($data),
            ], Response::HTTP_OK);
            
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function reviewStore($id, Request $request){
        $validator = Validator::make($request->all(), [
            'rate' => 'required',
            'comment' => 'required'
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
                'data' => []
            ], Response::HTTP_BAD_REQUEST);
        }
    
        try {
            $data = new HotelReview();
            $data->hotel_id = $id;
            $data->user_id = Auth::user()->id;
            $data->rating = $request->rate;
            $data->comment = $request->comment;
            $data->save();
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Review stored successfully',
                'validation' => $validation,
                'data' => $data
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
