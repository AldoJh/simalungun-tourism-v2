<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\EventAdmin;
use App\Models\HotelAdmin;
use App\Models\RestaurantAdmin;
use App\Models\TourismAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $admin): Response
    {
        if ($admin == 'event') {
            if(Auth::user()->role == 'superadmin'){
                return $next($request);
            }else{
                $event = EventAdmin::where('user_id', Auth::user()->id)->where('event_id', $request->id)->first();
                if($event){
                    return $next($request);
                }else{
                    return redirect()->to(route('dashboard'));
                }
            }
        };

        if ($admin == 'tourism') {
            if(Auth::user()->role == 'superadmin'){
                return $next($request);
            }else{
                $event = TourismAdmin::where('user_id', Auth::user()->id)->where('tourism_id', $request->id)->first();
                if($event){
                    return $next($request);
                }else{
                    return redirect()->to(route('dashboard'));
                }
            }
        }

        if ($admin == 'restaurant') {
            if(Auth::user()->role == 'superadmin'){
                return $next($request);
            }else{
                $event = RestaurantAdmin::where('user_id', Auth::user()->id)->where('restaurant_id', $request->id)->first();
                if($event){
                    return $next($request);
                }else{
                    return redirect()->to(route('dashboard'));
                }
            }
        }

        if ($admin == 'hotel') {
            if(Auth::user()->role == 'superadmin'){
                return $next($request);
            }else{
                $event = HotelAdmin::where('user_id', Auth::user()->id)->where('hotel_id', $request->id)->first();
                if($event){
                    return $next($request);
                }else{
                    return redirect()->to(route('dashboard'));
                }
            }
        }

        return redirect()->to(route('dashboard'));
    }
}
