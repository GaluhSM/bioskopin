@extends('layouts.admin')

@section('title', 'Booking Details')
@section('page-title', 'Booking Details')

@push('styles')
<style>
    .booking-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }
    
    .detail-card {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }
    
    .detail-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--gradient);
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
        margin-top: 20px;
    }
    
    .info-item {
        padding: 16px;
        background: #0f172a;
        border: 1px solid #2d3748;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    
    .info-item:hover {
        background: #1e293b;
        border-color: #4b5563;
    }
    
    .action-button {
        padding: 10px 16px;
        border-radius: 10px;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 500;
    }
    
    .action-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }
    
    .seat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(50px, 1fr));
        gap: 8px;
        margin-top: 16px;
    }
    
    .seat-item {
        background: #374151;
        border: 1px solid #4b5563;
        border-radius: 8px;
        padding: 8px;
        text-align: center;
        color: #d1d5db;
        font-weight: 600;
        font-size: 12px;
    }
    
    .qr-container {
        text-align: center;
        padding: 24px;
        background: #0f172a;
        border-radius: 16px;
        border: 1px solid #2d3748;
    }
</style>
@endpush

@section('content')
<div class="booking-container">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-ticket-alt text-white text-xl"></i>
                </div>
                Booking Details
            </h1>
            <p class="text-gray-400 mt-2">View complete booking information</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.bookings.index') }}" 
               class="action-button bg-gray-700 text-gray-300 hover:bg-gray-600">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
            @if($booking->status === 'pending_payment')
                <form action="{{ route('admin.bookings.mark-paid', $booking) }}" 
                      method="POST" class="inline" 
                      onsubmit="return confirm('Mark this booking as paid?')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="action-button bg-green-700 text-green-300 hover:bg-green-600">
                        <i class="fas fa-check mr-2"></i>Mark as Paid
                    </button>
                </form>
                <form action="{{ route('admin.bookings.cancel', $booking) }}" 
                      method="POST" class="inline" 
                      onsubmit="return confirm('Cancel this booking?')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="action-button bg-red-700 text-red-300 hover:bg-red-600">
                        <i class="fas fa-times mr-2"></i>Cancel Booking
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 text-green-800 px-6 py-4 rounded-xl mb-6 flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-gradient-to-r from-red-50 to-red-100 border border-red-200 text-red-800 px-6 py-4 rounded-xl mb-6 flex items-center">
            <i class="fas fa-exclamation-triangle text-red-500 mr-3 text-lg"></i>
            <span class="font-medium">{{ $errors->first() }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Customer Information -->
        <div class="detail-card" style="--gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-user text-white text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white">Customer Information</h3>
            </div>
            
            <div class="space-y-4">
                <div class="info-item">
                    <p class="text-sm font-medium text-gray-400 mb-1">Full Name</p>
                    <p class="text-lg font-semibold text-white">{{ $booking->customer_name }}</p>
                </div>
                <div class="info-item">
                    <p class="text-sm font-medium text-gray-400 mb-1">Phone Number</p>
                    <p class="text-lg font-semibold text-white">{{ $booking->customer_phone }}</p>
                </div>
                <div class="info-item">
                    <p class="text-sm font-medium text-gray-400 mb-1">Booking Code</p>
                    <p class="text-lg font-mono font-bold text-white bg-gray-700 px-3 py-2 rounded-lg">{{ $booking->unique_code }}</p>
                </div>
                <div class="info-item">
                    <p class="text-sm font-medium text-gray-400 mb-1">Status</p>
                    <span class="inline-flex px-4 py-2 text-sm font-bold rounded-full
                        @if($booking->status === 'pending_payment') bg-yellow-900 text-yellow-300
                        @elseif($booking->status === 'paid') bg-green-900 text-green-300  
                        @elseif($booking->status === 'cancelled') bg-red-900 text-red-300
                        @else bg-gray-700 text-gray-300 @endif">
                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                    </span>
                </div>
                <div class="info-item">
                    <p class="text-sm font-medium text-gray-400 mb-1">Booking Date</p>
                    <p class="text-lg font-semibold text-white">{{ $booking->created_at->format('M j, Y - H:i') }} WIB</p>
                </div>
            </div>
        </div>

        <!-- Movie & Schedule Information -->
        <div class="detail-card" style="--gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-rose-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-film text-white text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white">Movie & Schedule</h3>
            </div>
            
            <div class="space-y-4">
                <div class="info-item">
                    <p class="text-sm font-medium text-gray-400 mb-1">Movie Title</p>
                    <p class="text-lg font-semibold text-white">{{ $booking->schedule->movie->title }}</p>
                </div>
                <div class="info-item">
                    <p class="text-sm font-medium text-gray-400 mb-1">Duration</p>
                    <p class="text-lg font-semibold text-white flex items-center">
                        <i class="fas fa-clock mr-2 text-gray-400"></i>{{ $booking->schedule->movie->duration_minutes }} minutes
                    </p>
                </div>
                <div class="info-item">
                    <p class="text-sm font-medium text-gray-400 mb-1">Rating</p>
                    <p class="text-lg font-semibold text-white">{{ $booking->schedule->movie->audience_rating }}</p>
                </div>
                <div class="info-item">
                    <p class="text-sm font-medium text-gray-400 mb-1">Cinema</p>
                    <p class="text-lg font-semibold text-white">{{ $booking->schedule->studio->cinema->name }}</p>
                </div>
                <div class="info-item">
                    <p class="text-sm font-medium text-gray-400 mb-1">Studio</p>
                    <p class="text-lg font-semibold text-white flex items-center">
                        <i class="fas fa-door-open mr-2 text-gray-400"></i>{{ $booking->schedule->studio->name }}
                    </p>
                </div>
                <div class="info-item">
                    <p class="text-sm font-medium text-gray-400 mb-1">Show Date & Time</p>
                    <p class="text-lg font-semibold text-white">{{ $booking->schedule->start_time->format('l, M j, Y') }}</p>
                    <p class="text-sm text-gray-300">{{ $booking->schedule->start_time->format('H:i') }} - {{ $booking->schedule->end_time->format('H:i') }} WIB</p>
                </div>
            </div>
        </div>

        <!-- Seats & Payment Information -->
        <div class="detail-card" style="--gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-chair text-white text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white">Seats & Payment</h3>
            </div>
            
            <div class="space-y-4">
                <div class="info-item">
                    <p class="text-sm font-medium text-gray-400 mb-1">Selected Seats ({{ $booking->seats->count() }})</p>
                    <div class="seat-grid">
                        @foreach($booking->seats as $seat)
                            <div class="seat-item">{{ $seat->row }}{{ $seat->number }}</div>
                        @endforeach
                    </div>
                </div>
                <div class="info-item">
                    <p class="text-sm font-medium text-gray-400 mb-1">Price per Seat</p>
                    <p class="text-lg font-semibold text-white">Rp {{ number_format($booking->schedule->price, 0, ',', '.') }}</p>
                </div>
                <div class="info-item">
                    <p class="text-sm font-medium text-gray-400 mb-1">Total Amount</p>
                    <p class="text-2xl font-bold text-white">Rp {{ number_format($booking->schedule->price * $booking->seats->count(), 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- QR Code Section -->
    <div class="detail-card mt-6" style="--gradient: linear-gradient(135deg, #fc466b 0%, #3f5efb 100%);">
        <div class="flex items-center mb-6">
            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-qrcode text-white text-xl"></i>
            </div>
            <h3 class="text-xl font-bold text-white">QR Code</h3>
        </div>
        
        <div class="qr-container">
            <div class="mb-4">
                <p class="text-gray-400 mb-2">Scan this QR code for ticket verification</p>
                <div class="inline-block p-4 bg-white rounded-2xl">
                    {!! QrCode::format('svg')->size(200)->generate($booking->unique_code) !!}
                </div>
            </div>
            <div class="text-center">
                <p class="text-lg font-mono font-bold text-white bg-gray-700 px-4 py-2 rounded-lg inline-block">
                    {{ $booking->unique_code }}
                </p>
            </div>
        </div>
    </div>

    <!-- Action Buttons (Mobile) -->
    <div class="detail-card mt-6 lg:hidden">
        <div class="flex flex-col space-y-3">
            @if($booking->status === 'pending_payment')
                <form action="{{ route('admin.bookings.mark-paid', $booking) }}" 
                      method="POST" onsubmit="return confirm('Mark this booking as paid?')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-full action-button bg-green-700 text-green-300 hover:bg-green-600 py-3">
                        <i class="fas fa-check mr-2"></i>Mark as Paid
                    </button>
                </form>
                <form action="{{ route('admin.bookings.cancel', $booking) }}" 
                      method="POST" onsubmit="return confirm('Cancel this booking?')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-full action-button bg-red-700 text-red-300 hover:bg-red-600 py-3">
                        <i class="fas fa-times mr-2"></i>Cancel Booking
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
// Auto-refresh status every 30 seconds if pending
@if($booking->status === 'pending_payment')
setInterval(function() {
    location.reload();
}, 30000);
@endif
</script>
@endpush
@endsection