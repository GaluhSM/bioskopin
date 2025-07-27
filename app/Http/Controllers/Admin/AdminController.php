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
        $paidBookings = Booking::where('status', 'paid')->count();
        $cancelledBookings = Booking::where('status', 'cancelled')->count();
        
        $recentBookings = Booking::with(['schedule.movie', 'schedule.studio.cinema'])
                                ->latest()
                                ->take(10)
                                ->get();

        // Today's revenue
        $todayRevenue = Booking::where('status', 'paid')
            ->whereDate('created_at', now())
            ->with(['schedule', 'seats'])
            ->get()
            ->sum(function ($booking) {
                return $booking->schedule->price * $booking->seats->count();
            });

        // This month's revenue
        $monthRevenue = Booking::where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->with(['schedule', 'seats'])
            ->get()
            ->sum(function ($booking) {
                return $booking->schedule->price * $booking->seats->count();
            });
        
        return view('admin.dashboard', compact(
            'totalMovies', 
            'totalCinemas', 
            'totalBookings', 
            'pendingBookings',
            'paidBookings',
            'cancelledBookings',
            'recentBookings',
            'todayRevenue',
            'monthRevenue'
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

    public function updateBookingStatus(Request $request)
    {
        $request->validate([
            'unique_code' => 'required|string',
            'status' => 'required|in:pending_payment,paid,cancelled'
        ]);

        $booking = Booking::where('unique_code', $request->unique_code)->first();

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ]);
        }

        $booking->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Booking status updated successfully',
            'booking' => $booking->load(['schedule.movie', 'schedule.studio.cinema', 'seats'])
        ]);
    }
}