<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Models\EventViewer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EventResource;
use Illuminate\Database\QueryException;

class EventController extends Controller
{
    public function index(Request $request){
        try {
            $keyword = $request->input('q');
            $perPage = $request->input('perpage', 10);            
            $data = Event::where('name', 'like', "%$keyword%")->paginate($perPage);
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Event retrieved successfully',
                'data' => EventResource::collection($data)
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

            $viewer = new EventViewer();
            $viewer->event_id = $id;
            $viewer->user_id = Auth::user()->id ?? null;
            $viewer->save();

            $data = Event::where('id', $id)->get();
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
                'message' => 'Event show retrieved successfully',
                'data' => EventResource::collection($data)->first()
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
