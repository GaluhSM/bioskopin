@extends('layouts.admin')

@section('title', 'Schedule Details')
@section('page-title', 'Schedule Details')

@push('styles')
<style>
    .schedule-detail-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }

    .detail-card {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
        margin-bottom: 24px;
    }
    
    .detail-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #f59e0b, #d97706);
    }
    
    .movie-hero {
        display: flex;
        align-items: flex-start;
        gap: 32px;
        margin-bottom: 32px;
    }
    
    .movie-poster {
        width: 200px;
        height: 280px;
        border-radius: 16px;
        overflow: hidden;
        flex-shrink: 0;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    }
    
    .poster-placeholder {
        background: linear-gradient(135deg, #374151 0%, #4b5563 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }
    
    .movie-info h1 {
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 16px;
        line-height: 1.2;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .info-item {
        background: #374151;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }
    
    .info-item:hover {
        background: #4b5563;
        transform: translateY(-2px);
    }
    
    .info-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        flex-shrink: 0;
    }
    
    .info-content h3 {
        color: #e5e7eb;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }
    
    .info-content p {
        color: white;
        font-size: 1.125rem;
        font-weight: 600;
        margin: 0;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .status-upcoming { 
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        color: white;
    }
    .status-active { 
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }
    .status-ended { 
        background: linear-gradient(135deg, #6b7280, #4b5563);
        color: white;
    }
    
    .price-display {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        font-size: 1.5rem;
        font-weight: 800;
        padding: 16px 24px;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(16, 185, 129, 0.2);
    }
    
    .action-buttons {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }
    
    .action-btn {
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        font-size: 14px;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        color: white;
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }
    
    .btn-secondary {
        background: #374151;
        color: #e5e7eb;
        border: 1px solid #4b5563;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    
    .bookings-section {
        background: #111827;
        border-radius: 16px;
        padding: 24px;
        margin-top: 32px;
    }
    
    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 24px;
    }
    
    .section-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
    }
    
    .booking-card {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        transition: all 0.3s ease;
    }
    
    .booking-card:hover {
        background: #243447;
        border-color: #4b5563;
    }
    
    .back-btn {
        background: #374151;
        color: #e5e7eb;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-bottom: 24px;
    }
    
    .back-btn:hover {
        background: #4b5563;
        transform: translateX(-4px);
    }
</style>
@endpush

@section('content')
<div class="schedule-detail-container">
    <!-- Back Button -->
    <a href="{{ route('admin.schedules.index') }}" class="back-btn">
        <i class="fas fa-arrow-left mr-2"></i>Back to Schedules
    </a>
    
    <!-- Main Detail Card -->
    <div class="detail-card">
        <!-- Movie Hero Section -->
        <div class="movie-hero">
            <!-- Movie Poster -->
            <div class="movie-poster">
                @if($schedule->movie->poster_url)
                    <img class="w-full h-full object-cover" 
                         src="{{ $schedule->movie->poster_url }}" 
                         alt="{{ $schedule->movie->title }}">
                @else
                    <div class="poster-placeholder">
                        <i class="fas fa-film text-gray-400 text-6xl"></i>
                    </div>
                @endif
            </div>
            
            <!-- Movie Info -->
            <div class="movie-info flex-1">
                <h1>{{ $schedule->movie->title }}</h1>
                
                <!-- Status Badge -->
                @php
                    $now = now();
                    $status = 'upcoming';
                    if ($now->between($schedule->start_time, $schedule->end_time)) {
                        $status = 'active';
                    } elseif ($now->gt($schedule->end_time)) {
                        $status = 'ended';
                    }
                @endphp
                <div class="mb-6">
                    <span class="status-badge status-{{ $status }}">
                        <i class="fas fa-circle mr-2"></i>{{ ucfirst($status) }}
                    </span>
                </div>
                
                <!-- Movie Description -->
                @if($schedule->movie->description)
                <div class="text-gray-300 text-lg leading-relaxed mb-6">
                    {{ Str::limit($schedule->movie->description, 300) }}
                </div>
                @endif
                
                <!-- Price Display -->
                <div class="price-display">
                    <div class="text-sm opacity-80 mb-1">Ticket Price</div>
                    <div>Rp {{ number_format($schedule->price, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        
        <!-- Schedule Information Grid -->
        <div class="info-grid">
            <!-- Cinema Info -->
            <div class="info-item">
                <div class="info-icon bg-gradient-to-br from-blue-500 to-blue-600">
                    <i class="fas fa-building text-white text-xl"></i>
                </div>
                <div class="info-content">
                    <h3>Cinema</h3>
                    <p>{{ $schedule->studio->cinema->name }}</p>
                </div>
            </div>
            
            <!-- Studio Info -->
            <div class="info-item">
                <div class="info-icon bg-gradient-to-br from-purple-500 to-purple-600">
                    <i class="fas fa-door-open text-white text-xl"></i>
                </div>
                <div class="info-content">
                    <h3>Studio</h3>
                    <p>{{ $schedule->studio->name }}</p>
                </div>
            </div>
            
            <!-- Date -->
            <div class="info-item">
                <div class="info-icon bg-gradient-to-br from-green-500 to-green-600">
                    <i class="fas fa-calendar text-white text-xl"></i>
                </div>
                <div class="info-content">
                    <h3>Date</h3>
                    <p>{{ $schedule->start_time->format('l, F j, Y') }}</p>
                </div>
            </div>
            
            <!-- Start Time -->
            <div class="info-item">
                <div class="info-icon bg-gradient-to-br from-amber-500 to-amber-600">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                <div class="info-content">
                    <h3>Start Time</h3>
                    <p>{{ $schedule->start_time->format('H:i') }} WIB</p>
                </div>
            </div>
            
            <!-- End Time -->
            <div class="info-item">
                <div class="info-icon bg-gradient-to-br from-red-500 to-red-600">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                <div class="info-content">
                    <h3>End Time</h3>
                    <p>{{ $schedule->end_time->format('H:i') }} WIB</p>
                </div>
            </div>
            
            <!-- Duration -->
            <div class="info-item">
                <div class="info-icon bg-gradient-to-br from-indigo-500 to-indigo-600">
                    <i class="fas fa-stopwatch text-white text-xl"></i>
                </div>
                <div class="info-content">
                    <h3>Duration</h3>
                    <p>{{ $schedule->movie->duration_minutes }} minutes</p>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('admin.schedules.edit', $schedule) }}" class="action-btn btn-warning">
                <i class="fas fa-edit mr-2"></i>Edit Schedule
            </a>
            
            <a href="{{ route('admin.movies.show', $schedule->movie) }}" class="action-btn btn-primary">
                <i class="fas fa-film mr-2"></i>View Movie Details
            </a>
            
            <a href="{{ route('admin.studios.show', $schedule->studio) }}" class="action-btn btn-secondary">
                <i class="fas fa-door-open mr-2"></i>View Studio Details
            </a>
            
            <form action="{{ route('admin.schedules.destroy', $schedule) }}" 
                  method="POST" class="inline" 
                  onsubmit="return confirm('Are you sure? This will delete the schedule and may affect existing bookings.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn btn-danger">
                    <i class="fas fa-trash mr-2"></i>Delete Schedule
                </button>
            </form>
        </div>
    </div>
    
    <!-- Bookings Section -->
    @if($schedule->bookings->count() > 0)
    <div class="bookings-section">
        <div class="section-header">
            <div class="section-icon">
                <i class="fas fa-ticket-alt text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-white">Bookings</h2>
                <p class="text-gray-400">{{ $schedule->bookings->count() }} total bookings for this schedule</p>
            </div>
        </div>
        
        <div class="grid gap-4">
            @foreach($schedule->bookings as $booking)
            <div class="booking-card">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <h4 class="text-lg font-semibold text-white mr-3">{{ $booking->customer_name }}</h4>
                            <span class="px-3 py-1 text-xs rounded-full font-semibold
                                @if($booking->status === 'confirmed') bg-green-900 text-green-300
                                @elseif($booking->status === 'pending') bg-yellow-900 text-yellow-300
                                @else bg-red-900 text-red-300 @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-300">
                            <div>
                                <span class="font-medium">Email:</span> {{ $booking->customer_email }}
                            </div>
                            <div>
                                <span class="font-medium">Phone:</span> {{ $booking->customer_phone }}
                            </div>
                            <div>
                                <span class="font-medium">Booking Code:</span> 
                                <span class="font-mono text-amber-400">{{ $booking->unique_code }}</span>
                            </div>
                        </div>
                        
                        @if($booking->seats->count() > 0)
                        <div class="mt-3">
                            <span class="text-sm font-medium text-gray-400">Seats: </span>
                            @foreach($booking->seats as $seat)
                                <span class="inline-block bg-gray-600 text-white px-2 py-1 rounded text-xs mr-1 mb-1">
                                    {{ $seat->seat_number }}
                                </span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    
                    <div class="text-right">
                        <div class="text-lg font-bold text-green-400 mb-2">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </div>
                        <a href="{{ route('admin.bookings.show', $booking) }}" 
                           class="text-blue-400 hover:text-blue-300 text-sm">
                            View Details →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="bookings-section">
        <div class="section-header">
            <div class="section-icon">
                <i class="fas fa-ticket-alt text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-white">Bookings</h2>
                <p class="text-gray-400">No bookings yet for this schedule</p>
            </div>
        </div>
        
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-gradient-to-br from-gray-700 to-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-ticket-alt text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-white mb-2">No Bookings Yet</h3>
            <p class="text-gray-400">This schedule doesn't have any bookings at the moment.</p>
        </div>
    </div>
    @endif
    
</div>
@endsection