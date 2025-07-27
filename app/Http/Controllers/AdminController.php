<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Movie;
use App\Models\Cinema;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalMovies = Movie::count();
        $totalCinemas = Cinema::count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending_payment')->count();
        
        $recentBookings = Booking::with(['schedule.movie', 'schedule.studio.cinema'])
                                ->latest()
                                ->take(10)
                                ->get();
        
        return view('admin.dashboard', compact(
            'totalMovies', 
            'totalCinemas', 
            'totalBookings', 
            'pendingBookings',
            'recentBookings'
        ));
    }

    public function qrScanner()
    {
        return view('admin.qr-scanner');
    }

    public function scanBooking(Request $request)
    {
        $request->validate([
            'unique_code' => 'required|string'
        ]);

        $booking = Booking::with(['schedule.movie', 'schedule.studio.cinema', 'seats'])
                         ->where('unique_code', $request->unique_code)
                         ->first();

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ]);
        }

        return response()->json([
            'success' => true,
            'booking' => $booking
        ]);
    }
}