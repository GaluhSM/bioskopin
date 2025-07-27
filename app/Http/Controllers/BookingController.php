<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $scheduleId = $request->get('schedule_id');
        $schedule = Schedule::with(['movie', 'studio.cinema'])->findOrFail($scheduleId);
        
        // Get available seats for this schedule
        $bookedSeatIds = Booking::whereHas('schedule', function($query) use ($scheduleId) {
            $query->where('id', $scheduleId);
        })->with('seats')->get()->pluck('seats')->flatten()->pluck('id');
        
        $availableSeats = Seat::where('studio_id', $schedule->studio_id)
                             ->whereNotIn('id', $bookedSeatIds)
                             ->orderBy('row')
                             ->orderBy('number')
                             ->get();
        
        return view('booking.create', compact('schedule', 'availableSeats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'seat_ids' => 'required|array|min:1',
            'seat_ids.*' => 'exists:seats,id'
        ]);

        // Check if seats are still available
        $bookedSeatIds = Booking::whereHas('schedule', function($query) use ($request) {
            $query->where('id', $request->schedule_id);
        })->with('seats')->get()->pluck('seats')->flatten()->pluck('id');
        
        $conflictingSeats = array_intersect($request->seat_ids, $bookedSeatIds->toArray());
        if (!empty($conflictingSeats)) {
            return back()->withErrors('Some selected seats are no longer available.');
        }

        // Create booking
        $booking = Booking::create([
            'schedule_id' => $request->schedule_id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'unique_code' => strtoupper(Str::random(10)),
            'status' => 'pending_payment',
        ]);

        // Attach seats to booking
        $booking->seats()->attach($request->seat_ids);

        return redirect()->route('booking.success', $booking->unique_code);
    }

    public function success($uniqueCode)
    {
        $booking = Booking::with(['schedule.movie', 'schedule.studio.cinema', 'seats'])
                         ->where('unique_code', $uniqueCode)
                         ->firstOrFail();

        // Generate QR Code
        $qrCode = QrCode::format('svg')
                      ->size(200)
                      ->generate($uniqueCode);
        
        return view('booking.success', compact('booking', 'qrCode'));
    }
}