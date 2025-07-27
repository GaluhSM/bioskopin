@extends('layouts.app')

@section('title', 'Book Ticket - ' . $schedule->movie->title)

@push('styles')
<style>
    .seat {
        transition: all 0.2s ease;
    }
    .seat.available {
        @apply bg-gray-400 hover:bg-blue-500 cursor-pointer;
    }
    .seat.selected {
        @apply bg-blue-600 text-white;
    }
    .seat.unavailable {
        @apply bg-red-600 cursor-not-allowed;
    }
</style>
@endpush

@section('content')
<div class="bg-gray-900 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Booking Header -->
        <div class="bg-gray-800 rounded-lg p-6 mb-8">
            <div class="flex items-center mb-4">
                <img src="{{ $schedule->movie->poster_url ?? 'https://via.placeholder.com/100x150/374151/9CA3AF' }}" 
                     alt="{{ $schedule->movie->title }}" 
                     class="w-16 h-24 object-cover rounded mr-4">
                <div>
                    <h1 class="text-2xl font-bold">{{ $schedule->movie->title }}</h1>
                    <p class="text-gray-300">{{ $schedule->studio->cinema->name }} - {{ $schedule->studio->name }}</p>
                    <p class="text-gray-400">
                        {{ $schedule->start_time->format('l, F j, Y') }} at {{ $schedule->start_time->format('H:i') }}
                    </p>
                    <p class="text-green-400 font-bold text-lg">Rp {{ number_format($schedule->price, 0, ',', '.') }} per seat</p>
                </div>
            </div>
        </div>

        <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
            @csrf
            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Seat Selection -->
                <div class="bg-gray-800 rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">
                        <i class="fas fa-couch mr-2 text-blue-400"></i>Select Your Seats
                    </h2>
                    
                    <!-- Screen -->
                    <div class="text-center mb-6">
                        <div class="bg-gray-700 text-white py-2 px-4 rounded-lg inline-block mb-2">
                            <i class="fas fa-desktop mr-2"></i>SCREEN
                        </div>
                    </div>
                    
                    <!-- Seat Map -->
                    <div class="space-y-2 mb-6">
                        @php
                            $seatsByRow = $availableSeats->groupBy('row');
                            $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
                        @endphp
                        
                        @foreach($rows as $row)
                            @if(isset($seatsByRow[$row]))
                                <div class="flex items-center space-x-2">
                                    <span class="w-6 text-center font-bold text-gray-400">{{ $row }}</span>
                                    @foreach($seatsByRow[$row] as $seat)
                                        <button type="button" 
                                                class="seat available w-8 h-8 rounded text-xs font-bold"
                                                data-seat-id="{{ $seat->id }}"
                                                data-seat-label="{{ $seat->row }}{{ $seat->number }}">
                                            {{ $seat->number }}
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                    
                    <!-- Legend -->
                    <div class="flex justify-center space-x-6 text-sm">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-gray-400 rounded mr-2"></div>
                            <span>Available</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-blue-600 rounded mr-2"></div>
                            <span>Selected</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-red-600 rounded mr-2"></div>
                            <span>Occupied</span>
                        </div>
                    </div>
                    
                    <!-- Selected Seats Display -->
                    <div id="selectedSeatsDisplay" class="mt-6 p-4 bg-gray-700 rounded-lg hidden">
                        <h3 class="font-semibold mb-2">Selected Seats:</h3>
                        <div id="selectedSeatsList" class="text-blue-400"></div>
                        <div id="totalPrice" class="text-green-400 font-bold mt-2"></div>
                    </div>
                </div>
                
                <!-- Customer Information -->
                <div class="bg-gray-800 rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">
                        <i class="fas fa-user mr-2 text-blue-400"></i>Customer Information
                    </h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-gray-300 mb-2">
                                Full Name *
                            </label>
                            <input type="text" 
                                   name="customer_name" 
                                   id="customer_name"
                                   value="{{ old('customer_name') }}"
                                   class="w-full px-4 py-3 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Enter your full name"
                                   required>
                            @error('customer_name')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-gray-300 mb-2">
                                Phone Number *
                            </label>
                            <input type="tel" 
                                   name="customer_phone" 
                                   id="customer_phone"
                                   value="{{ old('customer_phone') }}"
                                   class="w-full px-4 py-3 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Enter your phone number"
                                   required>
                            @error('customer_phone')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Movie & Schedule Info (Read-only) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Movie</label>
                                <input type="text" 
                                       value="{{ $schedule->movie->title }}"
                                       class="w-full px-4 py-3 bg-gray-600 text-gray-300 border border-gray-600 rounded-lg"
                                       readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Price per Seat</label>
                                <input type="text" 
                                       value="Rp {{ number_format($schedule->price, 0, ',', '.') }}"
                                       class="w-full px-4 py-3 bg-gray-600 text-gray-300 border border-gray-600 rounded-lg"
                                       readonly>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Cinema</label>
                                <input type="text" 
                                       value="{{ $schedule->studio->cinema->name }}"
                                       class="w-full px-4 py-3 bg-gray-600 text-gray-300 border border-gray-600 rounded-lg"
                                       readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Studio</label>
                                <input type="text" 
                                       value="{{ $schedule->studio->name }}"
                                       class="w-full px-4 py-3 bg-gray-600 text-gray-300 border border-gray-600 rounded-lg"
                                       readonly>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Showtime</label>
                            <input type="text" 
                                   value="{{ $schedule->start_time->format('l, F j, Y - H:i') }}"
                                   class="w-full px-4 py-3 bg-gray-600 text-gray-300 border border-gray-600 rounded-lg"
                                   readonly>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="mt-8">
                        <button type="submit" 
                                id="submitBtn"
                                class="w-full bg-blue-600 hover:bg-blue-700 disabled:bg-gray-600 disabled:cursor-not-allowed text-white font-bold py-3 px-4 rounded-lg transition-colors"
                                disabled>
                            <i class="fas fa-ticket-alt mr-2"></i>Book Tickets
                        </button>
                        <p class="text-gray-400 text-sm text-center mt-2">
                            Please select at least one seat to continue
                        </p>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('movie.show', $schedule->movie->id) }}" 
                           class="block w-full bg-gray-600 hover:bg-gray-700 text-white text-center font-bold py-3 px-4 rounded-lg transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>Back to Movie
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Hidden input for selected seats -->
            <input type="hidden" name="seat_ids" id="seatIds" value="">
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectedSeats = [];
    const seatPrice = {{ $schedule->price }};
    const seats = document.querySelectorAll('.seat.available');
    const submitBtn = document.getElementById('submitBtn');
    const seatIdsInput = document.getElementById('seatIds');
    const selectedSeatsDisplay = document.getElementById('selectedSeatsDisplay');
    const selectedSeatsList = document.getElementById('selectedSeatsList');
    const totalPrice = document.getElementById('totalPrice');

    seats.forEach(seat => {
        seat.addEventListener('click', function() {
            const seatId = this.dataset.seatId;
            const seatLabel = this.dataset.seatLabel;
            
            if (this.classList.contains('selected')) {
                // Deselect seat
                this.classList.remove('selected');
                this.classList.add('available');
                const index = selectedSeats.findIndex(s => s.id === seatId);
                if (index > -1) {
                    selectedSeats.splice(index, 1);
                }
            } else {
                // Select seat
                this.classList.remove('available');
                this.classList.add('selected');
                selectedSeats.push({
                    id: seatId,
                    label: seatLabel
                });
            }
            
            updateSelectedSeatsDisplay();
        });
    });

    function updateSelectedSeatsDisplay() {
        if (selectedSeats.length === 0) {
            selectedSeatsDisplay.classList.add('hidden');
            submitBtn.disabled = true;
            submitBtn.querySelector('i').className = 'fas fa-ticket-alt mr-2';
            submitBtn.innerHTML = '<i class="fas fa-ticket-alt mr-2"></i>Book Tickets';
        } else {
            selectedSeatsDisplay.classList.remove('hidden');
            submitBtn.disabled = false;
            
            // Update selected seats list
            const seatLabels = selectedSeats.map(seat => seat.label).join(', ');
            selectedSeatsList.textContent = seatLabels;
            
            // Update total price
            const total = selectedSeats.length * seatPrice;
            totalPrice.textContent = `Total: Rp ${total.toLocaleString('id-ID')}`;
            
            // Update submit button
            submitBtn.innerHTML = `<i class="fas fa-check mr-2"></i>Book ${selectedSeats.length} Ticket${selectedSeats.length > 1 ? 's' : ''}`;
        }
        
        // Update hidden input
        seatIdsInput.value = JSON.stringify(selectedSeats.map(seat => seat.id));
    }

    // Form submission
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        if (selectedSeats.length === 0) {
            e.preventDefault();
            alert('Please select at least one seat.');
            return;
        }
        
        // Update the hidden input with selected seat IDs
        const seatIds = selectedSeats.map(seat => seat.id);
        seatIdsInput.name = 'seat_ids[]';
        seatIdsInput.remove();
        
        // Create multiple hidden inputs for seat IDs
        seatIds.forEach(seatId => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'seat_ids[]';
            input.value = seatId;
            this.appendChild(input);
        });
    });
});
</script>
@endpush
@endsection