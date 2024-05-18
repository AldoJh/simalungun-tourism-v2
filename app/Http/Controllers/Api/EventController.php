<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class EventController extends Controller
{
    public function index(Request $request){
        try {
            $keyword = $request->input('q');
            $perPage = $request->input('per_page', 10);            
            $news = Event::where('name', 'like', "%$keyword%")->paginate($perPage);
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Event retrieved successfully',
                'data' => $news
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
            $event = Event::with('eventAttribute')->with('eventImage')->where('id', $id)->first();
            if (!$event) {
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
                'data' => $event
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
