@extends('layouts.app')

@section('title', 'Booking Success - CinemaTicket')

@section('content')
<div class="bg-gray-900 min-h-screen py-8">
    <div class="max-w-2xl mx-auto px-4">
        <!-- Success Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check text-2xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-green-400 mb-2">Booking Successful!</h1>
            <p class="text-gray-300">Your tickets have been reserved. Please proceed to the cinema for payment.</p>
        </div>

        <!-- QR Code Section -->
        <div class="bg-gray-800 rounded-lg p-8 mb-8 text-center">
            <h2 class="text-xl font-bold mb-4">
                <i class="fas fa-qrcode mr-2 text-blue-400"></i>Your Ticket QR Code
            </h2>
            
            <div class="bg-white p-6 rounded-lg inline-block mb-4">
                {!! QrCode::size(200)->generate($booking->unique_code) !!}
            </div>
            
            <p class="text-lg font-semibold text-blue-400 mb-2">{{ $booking->unique_code }}</p>
            <p class="text-gray-400 text-sm">Present this QR code at the cinema counter for payment and ticket collection</p>
        </div>

        <!-- Booking Details -->
        <div class="bg-gray-800 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-bold mb-4">
                <i class="fas fa-ticket-alt mr-2 text-blue-400"></i>Booking Details
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Movie Info -->
                <div>
                    <div class="flex items-start space-x-4 mb-4">
                        <img src="{{ $booking->schedule->movie->poster_url ?? 'https://via.placeholder.com/80x120/374151/9CA3AF' }}" 
                             alt="{{ $booking->schedule->movie->title }}" 
                             class="w-16 h-24 object-cover rounded">
                        <div>
                            <h3 class="font-bold text-lg">{{ $booking->schedule->movie->title }}</h3>
                            <p class="text-gray-400 text-sm">{{ $booking->schedule->movie->duration_minutes }} minutes</p>
                            <p class="text-gray-400 text-sm">{{ $booking->schedule->movie->audience_rating }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Customer Info -->
                <div>
                    <div class="space-y-3">
                        <div>
                            <span class="text-gray-400 text-sm">Customer Name:</span>
                            <p class="font-semibold">{{ $booking->customer_name }}</p>
                        </div>
                        <div>
                            <span class="text-gray-400 text-sm">Phone Number:</span>
                            <p class="font-semibold">{{ $booking->customer_phone }}</p>
                        </div>
                        <div>
                            <span class="text-gray-400 text-sm">Booking Status:</span>
                            <span class="inline-block px-2 py-1 bg-yellow-600 text-yellow-100 text-xs rounded-full">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cinema & Schedule Details -->
        <div class="bg-gray-800 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-bold mb-4">
                <i class="fas fa-map-marker-alt mr-2 text-blue-400"></i>Cinema & Schedule
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="space-y-3">
                        <div>
                            <span class="text-gray-400 text-sm">Cinema:</span>
                            <p class="font-semibold">{{ $booking->schedule->studio->cinema->name }}</p>
                        </div>
                        <div>
                            <span class="text-gray-400 text-sm">Location:</span>
                            <p class="font-semibold">{{ $booking->schedule->studio->cinema->location }}</p>
                        </div>
                        <div>
                            <span class="text-gray-400 text-sm">Studio:</span>
                            <p class="font-semibold">{{ $booking->schedule->studio->name }}</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="space-y-3">
                        <div>
                            <span class="text-gray-400 text-sm">Date:</span>
                            <p class="font-semibold">{{ $booking->schedule->start_time->format('l, F j, Y') }}</p>
                        </div>
                        <div>
                            <span class="text-gray-400 text-sm">Showtime:</span>
                            <p class="font-semibold">
                                {{ $booking->schedule->start_time->format('H:i') }} - {{ $booking->schedule->end_time->format('H:i') }}
                            </p>
                        </div>
                        <div>
                            <span class="text-gray-400 text-sm">Seats:</span>
                            <p class="font-semibold">
                                @foreach($booking->seats as $seat)
                                    <span class="inline-block bg-blue-600 text-white px-2 py-1 rounded text-sm mr-1">
                                        {{ $seat->row }}{{ $seat->number }}
                                    </span>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="bg-gray-800 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-bold mb-4">
                <i class="fas fa-receipt mr-2 text-blue-400"></i>Payment Summary
            </h2>
            
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span>Ticket Price ({{ $booking->seats->count() }} seat{{ $booking->seats->count() > 1 ? 's' : '' }}):</span>
                    <span>Rp {{ number_format($booking->schedule->price * $booking->seats->count(), 0, ',', '.') }}</span>
                </div>
                <hr class="border-gray-700">
                <div class="flex justify-between font-bold text-lg">
                    <span>Total Amount:</span>
                    <span class="text-green-400">Rp {{ number_format($booking->schedule->price * $booking->seats->count(), 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Important Notice -->
        <div class="bg-yellow-900 border-l-4 border-yellow-500 p-4 mb-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-400">Important Notice</h3>
                    <div class="mt-2 text-sm text-yellow-300">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Please arrive at the cinema at least 15 minutes before showtime</li>
                            <li>Present this QR code at the counter for payment and ticket collection</li>
                            <li>Your seats are reserved for 30 minutes before showtime</li>
                            <li>Payment must be completed at the cinema counter</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4">
            <button onclick="window.print()" 
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors">
                <i class="fas fa-print mr-2"></i>Print Ticket
            </button>
            <a href="{{ route('home') }}" 
               class="flex-1 bg-gray-600 hover:bg-gray-700 text-white text-center font-bold py-3 px-4 rounded-lg transition-colors">
                <i class="fas fa-home mr-2"></i>Back to Home
            </a>
        </div>
    </div>
</div>

@push('styles')
<style>
@media print {
    body * {
        visibility: hidden;
    }
    .printable, .printable * {
        visibility: visible;
    }
    .printable {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    nav, footer, .no-print {
        display: none !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Add printable class to main content for printing
document.querySelector('main').classList.add('printable');
</script>
@endpush
@endsection