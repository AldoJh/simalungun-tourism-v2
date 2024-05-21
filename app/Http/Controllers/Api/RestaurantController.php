<?php

namespace App\Http\Controllers\Api;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\RestaurantReview;
use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantMenuResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ReviewResource;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RestaurantResource;
use App\Models\RestaurantMenu;

class RestaurantController extends Controller
{
    public function index(Request $request){
        try {
            $keyword = $request->input('q');
            $perPage = $request->input('perPage', 10);            
            $data = Restaurant::where('name', 'like', "%$keyword%")->orderBy('is_recomended', 'desc')->paginate($perPage);
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Restaurant retrieved successfully',
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
                'data' => RestaurantResource::collection($data),
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
            $data = Restaurant::where('id', $id)->get();
            if (!$data) {
                return response()->json([
                    'response' => Response::HTTP_NOT_FOUND,
                    'success' => false,
                    'message' => 'Restaurant not found',
                ], Response::HTTP_NOT_FOUND);
            }
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Restaurant show retrieved successfully',
                'data' => RestaurantResource::collection($data)->first()
            ], Response::HTTP_OK);
            
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function menu($id){
        try {
            $data = RestaurantMenu::where('restaurant_id', $id)->get();
            if (!$data) {
                return response()->json([
                    'response' => Response::HTTP_NOT_FOUND,
                    'success' => false,
                    'message' => 'Menu not found',
                ], Response::HTTP_NOT_FOUND);
            }
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Menu retrieved successfully',
                'data' => RestaurantMenuResource::collection($data),
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
            $data = RestaurantReview::where('restaurant_id', $id)->get();
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
        if ($validator->fails()) {
            return response()->json([
                'response' => Response::HTTP_BAD_REQUEST,
                'success' => false,
                'message' => $validator->errors()->all(),
            ], Response::HTTP_BAD_REQUEST);
        }
        
        try {
            $data = New RestaurantReview();
            $data->restaurant_id = $id;
            $data->user_id = Auth::user()->id;
            $data->rating = $request->rate;
            $data->comment = $request->comment;
            $data->save();
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Review store successfully',
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
