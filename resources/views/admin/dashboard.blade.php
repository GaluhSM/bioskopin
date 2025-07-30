@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .metric-card {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 12px;
        padding: 24px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .metric-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--accent-color);
    }
    
    .metric-card:hover {
        background: #243447;
        border-color: #4b5563;
        transform: translateY(-2px);
    }
    
    .metric-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--icon-bg);
        color: var(--accent-color);
        margin-bottom: 16px;
    }
    
    .action-grid {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 12px;
        padding: 24px;
    }
    
    .action-item {
        display: flex;
        align-items: center;
        padding: 16px;
        border-radius: 8px;
        background: #111827;
        border: 1px solid #2d3748;
        transition: all 0.2s ease;
        color: #e5e7eb;
        text-decoration: none;
        margin-bottom: 12px;
    }
    
    .action-item:hover {
        background: #1e293b;
        border-color: var(--accent-color);
        transform: translateX(4px);
    }
    
    .data-table {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .table-header {
        background: #111827;
        border-bottom: 1px solid #374151;
        padding: 20px;
    }
    
    .table thead {
        background: #0f172a;
    }
    
    .table tbody tr {
        background: #1f2937;
        border-bottom: 1px solid #2d3748;
    }
    
    .table tbody tr:hover {
        background: #243447;
    }
    
    .status-pill {
        padding: 6px 12px;
        border-radius: 16px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .modal-backdrop {
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(4px);
    }
    
    .modal-content {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 16px;
    }
    
    .info-block {
        background: #111827;
        border: 1px solid #2d3748;
        border-radius: 10px;
        padding: 20px;
    }
</style>
@endpush

@section('content')
<!-- Header Section -->
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-white flex items-center mb-2">
            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-chart-line text-white text-xl"></i>
            </div>
            Dashboard Overview
        </h1>
        <p class="text-gray-400">Monitor your cinema operations and performance</p>
    </div>
    <div class="text-right text-gray-400">
        <div class="text-lg font-semibold">{{ now()->format('H:i') }}</div>
        <div class="text-sm">{{ now()->format('j M Y') }}</div>
    </div>
</div>

<!-- Metrics Grid -->
<div class="grid grid-cols-4 gap-6 mb-8">
    <div class="metric-card" style="--accent-color: #3b82f6; --icon-bg: rgba(59, 130, 246, 0.15);">
        <div class="metric-icon">
            <i class="fas fa-film text-xl"></i>
        </div>
        <div class="text-3xl font-bold text-white mb-1">{{ $totalMovies }}</div>
        <div class="text-gray-400 text-sm">Total Movies</div>
    </div>

    <div class="metric-card" style="--accent-color: #10b981; --icon-bg: rgba(16, 185, 129, 0.15);">
        <div class="metric-icon">
            <i class="fas fa-building text-xl"></i>
        </div>
        <div class="text-3xl font-bold text-white mb-1">{{ $totalCinemas }}</div>
        <div class="text-gray-400 text-sm">Cinema Locations</div>
    </div>

    <div class="metric-card" style="--accent-color: #8b5cf6; --icon-bg: rgba(139, 92, 246, 0.15);">
        <div class="metric-icon">
            <i class="fas fa-ticket-alt text-xl"></i>
        </div>
        <div class="text-3xl font-bold text-white mb-1">{{ $totalBookings }}</div>
        <div class="text-gray-400 text-sm">Total Bookings</div>
    </div>

    <div class="metric-card" style="--accent-color: #f59e0b; --icon-bg: rgba(245, 158, 11, 0.15);">
        <div class="metric-icon">
            <i class="fas fa-hourglass-half text-xl"></i>
        </div>
        <div class="text-3xl font-bold text-white mb-1">{{ $pendingBookings }}</div>
        <div class="text-gray-400 text-sm">Pending Payments</div>
    </div>
</div>

<!-- Actions & Stats Row -->
<div class="grid grid-cols-3 gap-6 mb-8">
    <!-- Quick Actions -->
    <div class="action-grid">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-bolt text-white"></i>
            </div>
            <h3 class="text-lg font-semibold text-white">Quick Actions</h3>
        </div>
        
        <a href="{{ route('admin.qr-scanner') }}" class="action-item" style="--accent-color: #3b82f6;">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                <i class="fas fa-qrcode text-white"></i>
            </div>
            <div>
                <div class="font-medium text-white">Scan QR Code</div>
                <div class="text-sm text-gray-400">Verify tickets</div>
            </div>
        </a>
        
        <a href="{{ route('admin.movies.create') }}" class="action-item" style="--accent-color: #10b981;">
            <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                <i class="fas fa-plus text-white"></i>
            </div>
            <div>
                <div class="font-medium text-white">Add Movie</div>
                <div class="text-sm text-gray-400">Expand catalog</div>
            </div>
        </a>
        
        <a href="{{ route('admin.schedules.create') }}" class="action-item" style="--accent-color: #8b5cf6;">
            <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-4">
                <i class="fas fa-calendar-plus text-white"></i>
            </div>
            <div>
                <div class="font-medium text-white">New Schedule</div>
                <div class="text-sm text-gray-400">Plan showtimes</div>
            </div>
        </a>
    </div>

    <!-- Today's Stats -->
    <div class="col-span-2 action-grid">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-orange-600 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-calendar-day text-white"></i>
            </div>
            <h3 class="text-lg font-semibold text-white">Today's Performance</h3>
        </div>
        
        <div class="grid grid-cols-3 gap-4">
            <div class="info-block text-center">
                <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-ticket-alt text-white"></i>
                </div>
                <div class="text-2xl font-bold text-white mb-1">
                    {{ $recentBookings->where('created_at', '>=', today())->count() }}
                </div>
                <div class="text-gray-400 text-sm">Bookings Today</div>
            </div>
            
            <div class="info-block text-center">
                <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-money-bill-wave text-white"></i>
                </div>
                <div class="text-xl font-bold text-white mb-1">
                    Rp {{ number_format($todayRevenue, 0, ',', '.') }}
                </div>
                <div class="text-gray-400 text-sm">Revenue Today</div>
            </div>
            
            <div class="info-block text-center">
                <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-couch text-white"></i>
                </div>
                <div class="text-2xl font-bold text-white mb-1">
                    {{ $recentBookings->where('created_at', '>=', today())->where('status', 'paid')->sum(function($booking) {
                        return $booking->seats->count();
                    }) }}
                </div>
                <div class="text-gray-400 text-sm">Seats Sold</div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings Table -->
<div class="data-table">
    <div class="table-header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-list text-white"></i>
                </div>
                <h3 class="text-lg font-semibold text-white">Recent Bookings</h3>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="text-blue-400 hover:text-blue-300 font-medium text-sm">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase">Customer</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase">Movie</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase">Cinema</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase">Showtime</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase">Seats</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase">Total</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentBookings as $booking)
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gray-600 rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-semibold text-sm">{{ substr($booking->customer_name, 0, 1) }}</span>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-white">{{ $booking->customer_name }}</div>
                                <div class="text-sm text-gray-400">{{ $booking->customer_phone }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-white">{{ $booking->schedule->movie->title }}</div>
                        <div class="text-sm text-gray-400">{{ $booking->schedule->movie->duration_minutes }} min</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-white">{{ $booking->schedule->studio->cinema->name }}</div>
                        <div class="text-sm text-gray-400">{{ $booking->schedule->studio->name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-white">{{ $booking->schedule->start_time->format('M j, Y') }}</div>
                        <div class="text-sm text-gray-400">{{ $booking->schedule->start_time->format('H:i') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($booking->seats as $seat)
                                <span class="bg-gray-700 text-gray-300 text-xs px-2 py-1 rounded font-medium">
                                    {{ $seat->row }}{{ $seat->number }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="status-pill
                            @if($booking->status === 'pending_payment') bg-yellow-900 text-yellow-300
                            @elseif($booking->status === 'paid') bg-green-900 text-green-300
                            @elseif($booking->status === 'cancelled') bg-red-900 text-red-300
                            @else bg-gray-700 text-gray-300 @endif">
                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-semibold text-white">
                            Rp {{ number_format($booking->schedule->price * $booking->seats->count(), 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-2">
                            <button onclick="showBookingDetails('{{ $booking->unique_code }}')"
                                    class="text-blue-400 hover:text-blue-300 p-2 hover:bg-gray-700 rounded-lg transition-colors"
                                    title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button onclick="scanQrCode('{{ $booking->unique_code }}')"
                                    class="text-green-400 hover:text-green-300 p-2 hover:bg-gray-700 rounded-lg transition-colors"
                                    title="View QR">
                                <i class="fas fa-qrcode"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-ticket-alt text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-300 font-medium">No recent bookings</p>
                            <p class="text-gray-500 text-sm">New bookings will appear here</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Booking Details Modal -->
<div id="bookingModal" class="fixed inset-0 modal-backdrop hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 w-11/12 md:w-3/4 lg:w-1/2 modal-content shadow-2xl">
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-600">
            <h3 class="text-xl font-semibold text-white flex items-center">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-ticket-alt text-white"></i>
                </div>
                Booking Details
            </h3>
            <button onclick="closeBookingModal()" class="text-gray-400 hover:text-gray-300 p-2 hover:bg-gray-700 rounded-lg">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <div id="bookingDetails" class="space-y-4">
            <!-- Booking details will be loaded here -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function showBookingDetails(uniqueCode) {
    fetch(`{{ route('admin.scan-booking') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ unique_code: uniqueCode })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayBookingDetails(data.booking);
            document.getElementById('bookingModal').classList.remove('hidden');
        } else {
            alert('Booking not found');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error fetching booking details');
    });
}

function displayBookingDetails(booking) {
    const seatsHtml = booking.seats.map(seat => 
        `<span class="bg-gray-700 text-gray-300 text-xs px-3 py-1 rounded font-medium mr-1">${seat.row}${seat.number}</span>`
    ).join('');

    const detailsHtml = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="info-block">
                <h4 class="font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-user mr-2 text-blue-400"></i>Customer Information
                </h4>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Name:</span>
                        <span class="font-medium text-white">${booking.customer_name}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Phone:</span>
                        <span class="font-medium text-white">${booking.customer_phone}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Code:</span>
                        <span class="font-mono text-sm bg-gray-700 text-gray-300 px-2 py-1 rounded">${booking.unique_code}</span>
                    </div>
                </div>
            </div>
            <div class="info-block">
                <h4 class="font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-film mr-2 text-green-400"></i>Movie & Schedule
                </h4>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Movie:</span>
                        <span class="font-medium text-white">${booking.schedule.movie.title}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Cinema:</span>
                        <span class="font-medium text-white">${booking.schedule.studio.cinema.name}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Studio:</span>
                        <span class="font-medium text-white">${booking.schedule.studio.name}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Showtime:</span>
                        <span class="font-medium text-white">${new Date(booking.schedule.start_time).toLocaleString()}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 info-block">
            <h4 class="font-semibold text-white mb-4 flex items-center">
                <i class="fas fa-couch mr-2 text-purple-400"></i>Seats & Payment
            </h4>
            <div class="space-y-4">
                <div>
                    <span class="text-gray-400 block mb-2">Selected Seats:</span>
                    <div>${seatsHtml}</div>
                </div>
                <div class="flex justify-between items-center pt-4 border-t border-gray-600">
                    <span class="text-gray-400">Total Amount:</span>
                    <span class="text-xl font-bold text-green-400">Rp ${(booking.schedule.price * booking.seats.length).toLocaleString('id-ID')}</span>
                </div>
            </div>
        </div>
    `;

    document.getElementById('bookingDetails').innerHTML = detailsHtml;
}

function closeBookingModal() {
    document.getElementById('bookingModal').classList.add('hidden');
}

function scanQrCode(uniqueCode) {
    window.location.href = `{{ route('admin.qr-scanner') }}?code=${uniqueCode}`;
}
</script>
@endpush