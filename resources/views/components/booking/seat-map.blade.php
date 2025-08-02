<div class="lg:col-span-2">
    <div class="bg-gray-800 rounded-lg p-6">
        <h2 class="text-xl font-bold text-white mb-6">Pilih kursimu</h2>
        
        <x-booking.screen />
        
        <div id="seat-map" class="space-y-3 mb-6">
            @php
                $seatsByRow = $availableSeats->groupBy('row');
                $bookedSeatIds = \App\Models\Booking::whereHas('schedule', function($query) use ($schedule) {
                    $query->where('id', $schedule->id);
                })
                ->whereIn('status', ['pending_payment', 'paid'])
                ->with('seats')
                ->get()
                ->pluck('seats')
                ->flatten()
                ->pluck('id')
                ->toArray();
                
                $allSeats = \App\Models\Seat::where('studio_id', $schedule->studio_id)
                                        ->orderBy('row')
                                        ->orderBy('number')
                                        ->get()
                                        ->groupBy('row');
            @endphp
            
            @foreach($allSeats as $row => $seats)
                <div class="flex items-center justify-center space-x-2">
                    <span class="text-white font-bold w-8 text-center">{{ $row }}</span>
                    @foreach($seats as $seat)
                        @php
                            $isBooked = in_array($seat->id, $bookedSeatIds);
                        @endphp
                        <button type="button" 
                                class="seat-btn w-8 h-8 rounded text-xs font-bold transition-all duration-200
                                    {{ $isBooked ? 'bg-red-600 text-white cursor-not-allowed' : 'bg-gray-600 hover:bg-blue-500 text-white' }}"
                                data-seat-id="{{ $seat->id }}"
                                data-seat-label="{{ $seat->row }}{{ $seat->number }}"
                                {{ $isBooked ? 'disabled' : '' }}>
                            {{ $seat->number }}
                        </button>
                    @endforeach
                </div>
            @endforeach
        </div>
        
        <x-booking.seat-legend />
    </div>
</div>