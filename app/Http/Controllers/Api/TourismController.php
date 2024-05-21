<?php

namespace App\Http\Controllers\Api;

use App\Models\Tourism;
use App\Models\TourismGuide;
use Illuminate\Http\Request;
use App\Models\TourismReview;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TourismResource;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\TourismGuideResource;
use App\Http\Resources\TourismReviewResource;

class TourismController extends Controller
{
    public function index(Request $request){
        try {
            $keyword = $request->input('q');
            $perPage = $request->input('perPage', 10);            
            $data = Tourism::where('name', 'like', "%$keyword%")->orderBy('is_recomended', 'desc')->paginate($perPage);
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Tourism place retrieved successfully',
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
                'data' => TourismResource::collection($data),
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
            $tourism = Tourism::where('id', $id)->get();
            if (!$tourism) {
                return response()->json([
                    'response' => Response::HTTP_NOT_FOUND,
                    'success' => false,
                    'message' => 'Tourism not found',
                ], Response::HTTP_NOT_FOUND);
            }
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Tourism show retrieved successfully',
                'data' => TourismResource::collection($tourism)->first()
            ], Response::HTTP_OK);
            
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function guide($id){
        try {
            $data = TourismGuide::where('tourism_id', $id)->get();
            if (!$data) {
                return response()->json([
                    'response' => Response::HTTP_NOT_FOUND,
                    'success' => false,
                    'message' => 'Guide not found',
                ], Response::HTTP_NOT_FOUND);
            }
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Guide retrieved successfully',
                'data' => TourismGuideResource::collection($data),
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
            $data = TourismReview::where('tourism_id', $id)->get();
            if (!$data) {
                return response()->json([
                    'response' => Response::HTTP_NOT_FOUND,
                    'success' => false,
                    'message' => 'Guide not found',
                ], Response::HTTP_NOT_FOUND);
            }
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Review retrieved successfully',
                'data' => TourismReviewResource::collection($data),
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
            $data = New TourismReview();
            $data->tourism_id = $id;
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
