@extends('layouts.app')

@section('title', 'Booking Successful')

@section('content')
<div class="min-h-screen bg-gray-900 py-12">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Success Header -->
        <div class="text-center mb-8">
            <div class="bg-green-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check text-3xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Booking Successful!</h1>
            <p class="text-gray-400">Your tickets have been reserved. Please pay at the cinema counter.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Booking Details -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-xl font-bold text-white mb-4">
                    <i class="fas fa-ticket-alt mr-2 text-blue-400"></i>Booking Details
                </h2>
                
                <div class="space-y-4">
                    <!-- Customer Info -->
                    <div class="border-b border-gray-700 pb-4">
                        <h3 class="text-sm font-medium text-gray-400 mb-2">Customer Information</h3>
                        <p class="text-white"><span class="text-gray-400">Name:</span> {{ $booking->customer_name }}</p>
                        <p class="text-white"><span class="text-gray-400">Phone:</span> {{ $booking->customer_phone }}</p>
                        <p class="text-white"><span class="text-gray-400">Booking Code:</span> 
                            <span class="font-mono text-blue-400">{{ $booking->unique_code }}</span>
                        </p>
                    </div>

                    <!-- Movie Info -->
                    <div class="border-b border-gray-700 pb-4">
                        <h3 class="text-sm font-medium text-gray-400 mb-2">Movie Information</h3>
                        <p class="text-white font-semibold">{{ $booking->schedule->movie->title }}</p>
                        <p class="text-gray-400">{{ $booking->schedule->movie->duration_minutes }} minutes • {{ $booking->schedule->movie->audience_rating }}</p>
                    </div>

                    <!-- Cinema & Schedule -->
                    <div class="border-b border-gray-700 pb-4">
                        <h3 class="text-sm font-medium text-gray-400 mb-2">Cinema & Schedule</h3>
                        <p class="text-white">{{ $booking->schedule->studio->cinema->name }}</p>
                        <p class="text-gray-400">{{ $booking->schedule->studio->name }}</p>
                        <p class="text-gray-400">{{ $booking->schedule->start_time->format('l, F j, Y') }}</p>
                        <p class="text-gray-400">{{ $booking->schedule->start_time->format('H:i') }} - {{ $booking->schedule->end_time->format('H:i') }}</p>
                    </div>

                    <!-- Seats -->
                    <div class="border-b border-gray-700 pb-4">
                        <h3 class="text-sm font-medium text-gray-400 mb-2">Selected Seats</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($booking->seats as $seat)
                                <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm">
                                    {{ $seat->row }}{{ $seat->number }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-400 mb-2">Payment Summary</h3>
                        <div class="space-y-1">
                            <div class="flex justify-between text-gray-400">
                                <span>Price per seat:</span>
                                <span>Rp {{ number_format($booking->schedule->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <span>Number of seats:</span>
                                <span>{{ $booking->seats->count() }}</span>
                            </div>
                            <div class="flex justify-between text-white font-bold text-lg border-t border-gray-700 pt-2">
                                <span>Total Amount:</span>
                                <span class="text-green-400">Rp {{ number_format($booking->schedule->price * $booking->seats->count(), 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="bg-yellow-900/30 border border-yellow-600 rounded p-3">
                        <div class="flex items-center">
                            <i class="fas fa-clock text-yellow-400 mr-2"></i>
                            <span class="text-yellow-200 font-medium">Status: Pending Payment</span>
                        </div>
                        <p class="text-yellow-200 text-sm mt-1">Please complete payment at the cinema counter</p>
                    </div>
                </div>
            </div>

            <!-- QR Code -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-xl font-bold text-white mb-4">
                    <i class="fas fa-qrcode mr-2 text-green-400"></i>Payment QR Code
                </h2>
                
                <div class="text-center">
                    <div class="bg-white p-6 rounded-lg inline-block mb-4">
                        {!! $qrCode !!}
                    </div>
                    
                    <div class="bg-blue-900/30 border border-blue-600 rounded-lg p-4 mb-4">
                        <h3 class="text-blue-200 font-medium mb-2">
                            <i class="fas fa-info-circle mr-2"></i>Payment Instructions
                        </h3>
                        <div class="text-blue-200 text-sm space-y-1">
                            <p>1. Take this QR code to the cinema counter</p>
                            <p>2. Show the QR code to the cashier</p>
                            <p>3. Complete your payment</p>
                            <p>4. Receive your physical tickets</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <button onclick="printTicket()" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors">
                            <i class="fas fa-print mr-2"></i>Print Booking Details
                        </button>
                        
                        <button onclick="shareBooking()" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors">
                            <i class="fas fa-share mr-2"></i>Share Booking
                        </button>
                        
                        <a href="{{ route('home') }}" 
                           class="block w-full bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg transition-colors text-center">
                            <i class="fas fa-home mr-2"></i>Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Important Notes -->
        <div class="mt-8 bg-red-900/30 border border-red-600 rounded-lg p-4">
            <h3 class="text-red-200 font-medium mb-2">
                <i class="fas fa-exclamation-triangle mr-2"></i>Important Notes
            </h3>
            <ul class="text-red-200 text-sm space-y-1">
                <li>• Your booking is valid for <strong>30 minutes</strong> before the showtime</li>
                <li>• Please arrive at least <strong>15 minutes early</strong> to complete payment</li>
                <li>• Bring a valid ID when collecting your tickets</li>
                <li>• This booking will be cancelled if payment is not completed on time</li>
            </ul>
        </div>
    </div>
</div>

@push('scripts')
<script>
function printTicket() {
    window.print();
}

function shareBooking() {
    if (navigator.share) {
        navigator.share({
            title: 'Movie Booking - {{ $booking->schedule->movie->title }}',
            text: 'Booking Code: {{ $booking->unique_code }}\nMovie: {{ $booking->schedule->movie->title }}\nDate: {{ $booking->schedule->start_time->format("l, F j, Y") }}\nTime: {{ $booking->schedule->start_time->format("H:i") }}',
            url: window.location.href
        });
    } else {
        // Fallback - copy to clipboard
        const bookingDetails = `Booking Code: {{ $booking->unique_code }}\nMovie: {{ $booking->schedule->movie->title }}\nDate: {{ $booking->schedule->start_time->format("l, F j, Y") }}\nTime: {{ $booking->schedule->start_time->format("H:i") }}\nCinema: {{ $booking->schedule->studio->cinema->name }}`;
        
        navigator.clipboard.writeText(bookingDetails).then(() => {
            alert('Booking details copied to clipboard!');
        });
    }
}
</script>
@endpush
@endsection