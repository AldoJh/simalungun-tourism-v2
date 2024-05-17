<?php

namespace App\Http\Controllers\Web\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Tourism;
use App\Models\Restaurant;
use App\Models\EventViewer;
use App\Models\HotelViewer;
use App\Models\EventVisitor;
use App\Models\HotelVisitor;
use Illuminate\Http\Request;
use App\Models\TourismViewer;
use App\Models\TourismVisitor;
use App\Models\RestaurantViewer;
use App\Models\RestaurantVisitor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request){
        $tahun = $request->input('tahun', date('Y'));

        if(Auth::user()->role != 'user'){
            $userData = User::whereYear('created_at', $tahun)->get();
            $monthlyUsers = [];
            for ($i = 1; $i <= 12; $i++) {
                $monthlyUsers[$i] = 0;
            }
            foreach ($userData as $user) {
                $month = (int)$user->created_at->format('n');
                $monthlyUsers[$month] += 1; 
            }
            $userChart = array_values($monthlyUsers);
    
            // Array 5 tahun kebelakang
            $fiveYearsAgo = [];
            for ($i = 0; $i < 5; $i++) {
                $fiveYearsAgo[] = (int)date('Y', strtotime("-$i year"));
            }
    
            $tourismVistor = TourismVisitor::whereYear('date', $tahun)
            ->get()
            ->groupBy('tourism_id')
            ->map(function ($items, $tourismId) {
                return [
                    'name' => $items->first()->tourism->name,
                    'value' => $items->sum('visitor'),
                ];
            })
            ->values();  
    
            $hotelVistor = HotelVisitor::whereYear('date', $tahun)
            ->get()
            ->groupBy('hotel_id')
            ->map(function ($items, $hotelId) {
                return [
                    'name' => $items->first()->hotel->name,
                    'value' => $items->sum('visitor'),
                ];
            })
            ->values();  
    
            $restaurantVistor = RestaurantVisitor::whereYear('date', $tahun)
            ->get()
            ->groupBy('restaurant_id')
            ->map(function ($items, $restaurantId) {
                return [
                    'name' => $items->first()->restaurant->name,
                    'value' => $items->sum('visitor'),
                ];
            })
            ->values();
    
            $eventVistor = EventVisitor::whereYear('date', $tahun)
            ->get()
            ->groupBy('event_id')
            ->map(function ($items, $eventId) {
                return [
                    'name' => $items->first()->event->name,
                    'value' => $items->sum('visitor'),
                ];
            })
            ->values();
    
            $featureViewer = [
                'tourismViewer' => TourismViewer::whereYear('created_at', $tahun)->count(),
                'hotelViewer' => HotelViewer::whereYear('created_at', $tahun)->count(),
                'restaurantViewer' => RestaurantViewer::whereYear('created_at', $tahun)->count(),
                'eventViewer' => EventViewer::whereYear('created_at', $tahun)->count()
            ];
    
            $guestViewer = [
                'tourismViewer' => TourismViewer::whereYear('created_at', $tahun)->where('user_id', null)->count(),
                'hotelViewer' => HotelViewer::whereYear('created_at', $tahun)->where('user_id', null)->count(),
                'restaurantViewer' => RestaurantViewer::whereYear('created_at', $tahun)->where('user_id', null)->count(),
                'eventViewer' => EventViewer::whereYear('created_at', $tahun)->where('user_id', null)->count()
            ];
    
            $userViewer = [
                'tourismViewer' => TourismViewer::whereYear('created_at', $tahun)->where('user_id', '!=', null)->count(),
                'hotelViewer' => HotelViewer::whereYear('created_at', $tahun)->where('user_id', '!=', null)->count(),
                'restaurantViewer' => RestaurantViewer::whereYear('created_at', $tahun)->where('user_id', '!=', null)->count(),
                'eventViewer' => EventViewer::whereYear('created_at', $tahun)->where('user_id', '!=', null)->count()
            ];
    
            $webViewer = [
                'guest' => array_sum($guestViewer),
                'user' => array_sum($userViewer)
            ];
        }

        $data = [
            'title' => 'Dashboard',
            'subTitle' => null,
            'page_id' => 7,
            'tourismCount' => Tourism::count() ?? null,
            'hotelCount' => Hotel::count() ?? null,
            'restaurantCount' => Restaurant::count() ?? null,
            'eventCount' => Event::count() ?? null,
            'userChart' => $userChart ?? null,
            'tourismChart' => $tourismVistor ?? null,
            'hotelChart' => $hotelVistor ?? null,
            'restaurantChart' => $restaurantVistor ?? null,
            'eventChart' => $eventVistor ?? null,
            'webChart' => $webViewer ?? null,
            'featureChart' => $featureViewer ?? null,
            'year' => $fiveYearsAgo ?? null
        ];
        // dd($data);
        return view('admin.dashboard',  $data);
    }
}
