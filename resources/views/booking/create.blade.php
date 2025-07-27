@extends('layouts.app')

@section('title', 'Book Tickets - ' . $schedule->movie->title)

@section('content')
<div class="bg-gray-900 min-h-screen py-8">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Booking Header -->
        <div class="bg-gray-800 rounded-lg p-6 mb-8">
            <div class="flex items-center mb-4">
                <a href="{{ route('movie.show', $schedule->movie->id) }}" 
                   class="text-gray-400 hover:text-white mr-4">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <h1 class="text-2xl font-bold text-white">Book Your Tickets</h1>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Movie Info -->
                <div class="flex space-x-4">
                    @if($schedule->movie->poster_url)
                        <img src="{{ asset('storage/' . $schedule->movie->poster_url) }}" 
                             alt="{{ $schedule->movie->title }}"
                             class="w-16 h-24 object-cover rounded">
                    @else
                        <div class="w-16 h-24 bg-gray-700 rounded flex items-center justify-center">
                            <i class="fas fa-film text-gray-500"></i>
                        </div>
                    @endif
                    <div>
                        <h2 class="text-lg font-semibold text-white">{{ $schedule->movie->title }}</h2>
                        <p class="text-gray-400 text-sm">{{ $schedule->movie->duration_minutes }} min • {{ $schedule->movie->audience_rating }}</p>
                    </div>
                </div>
                
                <!-- Cinema Info -->
                <div>
                    <h3 class="text-white font-medium mb-1">{{ $schedule->studio->cinema->name }}</h3>
                    <p class="text-gray-400 text-sm">{{ $schedule->studio->name }}</p>
                    <p class="text-gray-400 text-xs">{{ $schedule->studio->cinema->location }}</p>
                </div>
                
                <!-- Schedule Info -->
                <div>
                    <h3 class="text-white font-medium mb-1">{{ $schedule->start_time->format('l, F j, Y') }}</h3>
                    <p class="text-gray-400 text-sm">{{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }}</p>
                    <p class="text-green-400 font-bold">Rp {{ number_format($schedule->price, 0, ',', '.') }} / seat</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Seat Selection -->
            <div class="lg:col-span-2">
                <div class="bg-gray-800 rounded-lg p-6">
                    <h2 class="text-xl font-bold text-white mb-6">Select Your Seats</h2>
                    
                    <!-- Screen -->
                    <div class="mb-8">
                        <div class="bg-gradient-to-r from-gray-600 to-gray-700 rounded-lg py-4 text-center text-white font-semibold mb-4">
                            <i class="fas fa-desktop mr-2"></i>SCREEN
                        </div>
                    </div>
                    
                    <!-- Seat Map -->
                    <div id="seat-map" class="space-y-3 mb-6">
                        @php
                            $seatsByRow = $availableSeats->groupBy('row');
                            $bookedSeatIds = \App\Models\Booking::whereHas('schedule', function($query) use ($schedule) {
                                $query->where('id', $schedule->id);
                            })->with('seats')->get()->pluck('seats')->flatten()->pluck('id')->toArray();
                        @endphp
                        
                        @foreach($seatsByRow as $row => $seats)
                            <div class="flex items-center justify-center space-x-2">
                                <span class="text-white font-bold w-8 text-center">{{ $row }}</span>
                                @foreach($seats as $seat)
                                    <button type="button" 
                                            class="seat-btn w-8 h-8 rounded text-xs font-bold transition-all duration-200
                                                   {{ in_array($seat->id, $bookedSeatIds) ? 'bg-red-600 text-white cursor-not-allowed' : 'bg-gray-600 hover:bg-blue-500 text-white' }}"
                                            data-seat-id="{{ $seat->id }}"
                                            data-seat-label="{{ $seat->row }}{{ $seat->number }}"
                                            {{ in_array($seat->id, $bookedSeatIds) ? 'disabled' : '' }}>
                                        {{ $seat->number }}
                                    </button>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Legend -->
                    <div class="flex justify-center space-x-6 text-sm">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-gray-600 rounded mr-2"></div>
                            <span class="text-gray-400">Available</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-blue-500 rounded mr-2"></div>
                            <span class="text-gray-400">Selected</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-red-600 rounded mr-2"></div>
                            <span class="text-gray-400">Occupied</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Booking Form -->
            <div class="lg:col-span-1">
                <div class="bg-gray-800 rounded-lg p-6 sticky top-8">
                    <h2 class="text-xl font-bold text-white mb-6">Booking Details</h2>
                    
                    <form action="{{ route('booking.store') }}" method="POST" id="booking-form">
                        @csrf
                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                        <input type="hidden" name="seat_ids" id="seat-ids" value="">
                        
                        <!-- Selected Seats -->
                        <div class="mb-6">
                            <h3 class="text-white font-medium mb-2">Selected Seats</h3>
                            <div id="selected-seats" class="text-gray-400 text-sm min-h-[24px]">
                                No seats selected
                            </div>
                        </div>
                        
                        <!-- Customer Information -->
                        <div class="space-y-4 mb-6">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-white mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="customer_name" id="customer_name" 
                                       value="{{ old('customer_name') }}"
                                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Enter your full name" required>
                                @error('customer_name')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-white mb-2">
                                    Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" name="customer_phone" id="customer_phone" 
                                       value="{{ old('customer_phone') }}"
                                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="e.g., 08123456789" required>
                                @error('customer_phone')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Booking Summary -->
                        <div class="bg-gray-700 rounded-lg p-4 mb-6">
                            <h3 class="text-white font-medium mb-3">Booking Summary</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Price per seat:</span>
                                    <span class="text-white">Rp {{ number_format($schedule->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Number of seats:</span>
                                    <span class="text-white" id="seat-count">0</span>
                                </div>
                                <div class="border-t border-gray-600 pt-2 mt-2">
                                    <div class="flex justify-between font-bold">
                                        <span class="text-white">Total:</span>
                                        <span class="text-green-400" id="total-price">Rp 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" id="submit-btn"
                                class="w-full bg-blue-600 hover:bg-blue-700 disabled:bg-gray-600 disabled:cursor-not-allowed text-white font-bold py-3 px-4 rounded-lg transition-colors"
                                disabled>
                            <i class="fas fa-ticket-alt mr-2"></i>Book Now
                        </button>
                        
                        <!-- Booking Notice -->
                        <div class="mt-4 p-3 bg-yellow-900/30 border border-yellow-600 rounded-lg">
                            <p class="text-yellow-200 text-xs">
                                <i class="fas fa-info-circle mr-2"></i>
                                Please complete payment at the cinema counter within 30 minutes before showtime.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if($errors->any())
    <div class="fixed top-4 right-4 bg-red-600 text-white px-4 py-3 rounded-lg shadow-lg z-50">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    </div>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const seatPrice = {{ $schedule->price }};
    let selectedSeats = [];
    
    // Seat selection
    document.querySelectorAll('.seat-btn:not([disabled])').forEach(button => {
        button.addEventListener('click', function() {
            const seatId = this.dataset.seatId;
            const seatLabel = this.dataset.seatLabel;
            
            if (this.classList.contains('bg-blue-500')) {
                // Deselect seat
                this.classList.remove('bg-blue-500');
                this.classList.add('bg-gray-600');
                selectedSeats = selectedSeats.filter(seat => seat.id !== seatId);
            } else {
                // Select seat (max 8 seats)
                if (selectedSeats.length >= 8) {
                    alert('Maximum 8 seats can be selected at once.');
                    return;
                }
                this.classList.remove('bg-gray-600');
                this.classList.add('bg-blue-500');
                selectedSeats.push({id: seatId, label: seatLabel});
            }
            
            updateBookingSummary();
        });
    });
    
    function updateBookingSummary() {
        const seatCount = selectedSeats.length;
        const totalPrice = seatCount * seatPrice;
        
        // Update selected seats display
        const selectedSeatsDiv = document.getElementById('selected-seats');
        if (seatCount === 0) {
            selectedSeatsDiv.textContent = 'No seats selected';
            selectedSeatsDiv.className = 'text-gray-400 text-sm min-h-[24px]';
        } else {
            selectedSeatsDiv.innerHTML = selectedSeats.map(seat => 
                `<span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1 mb-1">${seat.label}</span>`
            ).join('');
            selectedSeatsDiv.className = 'text-white text-sm min-h-[24px]';
        }
        
        // Update summary
        document.getElementById('seat-count').textContent = seatCount;
        document.getElementById('total-price').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
        
        // Update form
        document.getElementById('seat-ids').value = selectedSeats.map(seat => seat.id).join(',');
        
        // Enable/disable submit button
        const submitBtn = document.getElementById('submit-btn');
        if (seatCount > 0) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-ticket-alt mr-2"></i>Book ' + seatCount + ' Seat' + (seatCount > 1 ? 's' : '');
        } else {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-ticket-alt mr-2"></i>Book Now';
        }
    }
    
    // Form validation
    document.getElementById('booking-form').addEventListener('submit', function(e) {
        if (selectedSeats.length === 0) {
            e.preventDefault();
            alert('Please select at least one seat.');
            return;
        }
        
        const customerName = document.getElementById('customer_name').value.trim();
        const customerPhone = document.getElementById('customer_phone').value.trim();
        
        if (!customerName || !customerPhone) {
            e.preventDefault();
            alert('Please fill in all customer information.');
            return;
        }
        
        // Add loading state
        const submitBtn = document.getElementById('submit-btn');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
        submitBtn.disabled = true;
    });
    
    // Phone number formatting
    document.getElementById('customer_phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.startsWith('0')) {
            value = '0' + value.slice(1);
        }
        e.target.value = value;
    });
    
    // Auto-hide error message
    const errorDiv = document.querySelector('.fixed.top-4.right-4.bg-red-600');
    if (errorDiv) {
        setTimeout(() => {
            errorDiv.style.opacity = '0';
            setTimeout(() => errorDiv.remove(), 300);
        }, 5000);
    }
});
</script>
@endpush

@push('styles')
<style>
.seat-btn:disabled {
    cursor: not-allowed !important;
}

.seat-btn:not(:disabled):hover {
    transform: scale(1.1);
}

@media (max-width: 640px) {
    .seat-btn {
        width: 1.5rem;
        height: 1.5rem;
        font-size: 0.625rem;
    }
}
</style>
@endpush
@endsection