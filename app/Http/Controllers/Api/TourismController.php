<?php

namespace App\Http\Controllers\Api;

use App\Models\Tourism;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourismResource;
use Illuminate\Database\QueryException;

class TourismController extends Controller
{
    public function index(Request $request){
        try {
            $keyword = $request->input('q');
            $perPage = $request->input('perPage', 10);            
            $data = Tourism::with('TourismCategory')->where('name', 'like', "%$keyword%")->orderBy('is_recomended', 'desc')->paginate($perPage);
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
}
