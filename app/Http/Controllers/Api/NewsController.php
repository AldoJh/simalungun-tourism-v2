<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use App\Models\Comment;
use App\Models\NewsViewer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index(Request $request){
        try {
            $keyword = $request->input('q');
            $perPage = $request->input('perPage', 10);            
            $data = News::where('title', 'like', "%$keyword%")->paginate($perPage);
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'News retrieved successfully',
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
                'data' => NewsResource::collection($data)
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

            $viewer = New NewsViewer();
            $viewer->news_id = $id;
            $viewer->user_id = Auth::user()->id ?? null;
            $viewer->save();

            $data = News::where('id', $id)->get();
            if (!$data) {
                return response()->json([
                    'response' => Response::HTTP_NOT_FOUND,
                    'success' => false,
                    'message' => 'News not found',
                ], Response::HTTP_NOT_FOUND);
            }
    
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'News show retrieved successfully',
                'data' => NewsResource::collection($data)->first()
            ], Response::HTTP_OK);
            
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function comment($id, Request $request){
        $validator = Validator::make($request->all(), [
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
            $comment = New Comment();
            $comment->news_id = $id;
            $comment->user_id = Auth::user()->id;
            $comment->content = $request->comment;
            $comment->save();
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Comment store successfully',
                'data' => $comment
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
