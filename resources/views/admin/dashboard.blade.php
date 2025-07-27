@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .stats-card {
        background: white;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(229, 231, 235, 0.5);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient);
    }
    
    .stats-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
    }
    
    .icon-container {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-gradient);
    }
    
    .quick-action-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        transition: all 0.3s ease;
        border: 1px solid rgba(229, 231, 235, 0.5);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .quick-action-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .action-item {
        display: flex;
        align-items: center;
        padding: 16px;
        border-radius: 12px;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    
    .action-item:hover {
        transform: translateX(4px);
    }
    
    .table-container {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(229, 231, 235, 0.5);
    }
    
    .table-header {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e2e8f0;
    }
    
    .status-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
@endpush

@section('content')
<!-- Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-tachometer-alt text-white text-xl"></i>
                </div>
                Dashboard
            </h1>
            <p class="text-gray-600 mt-2">Welcome back! Here's what's happening with your cinema.</p>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</p>
            <p class="text-xs text-gray-400">{{ now()->format('H:i') }} WIB</p>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Movies -->
    <div class="stats-card" style="--gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%); --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <p class="text-gray-600 text-sm font-medium mb-1">Total Movies</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalMovies }}</p>
                <p class="text-xs text-gray-500 mt-2">Active in system</p>
            </div>
            <div class="icon-container">
                <i class="fas fa-film text-white text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Cinemas -->
    <div class="stats-card" style="--gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); --bg-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <p class="text-gray-600 text-sm font-medium mb-1">Total Cinemas</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalCinemas }}</p>
                <p class="text-xs text-gray-500 mt-2">Locations managed</p>
            </div>
            <div class="icon-container">
                <i class="fas fa-building text-white text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Bookings -->
    <div class="stats-card" style="--gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%); --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <p class="text-gray-600 text-sm font-medium mb-1">Total Bookings</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalBookings }}</p>
                <p class="text-xs text-gray-500 mt-2">All time bookings</p>
            </div>
            <div class="icon-container">
                <i class="fas fa-ticket-alt text-white text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Pending Payments -->
    <div class="stats-card" style="--gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); --bg-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <p class="text-gray-600 text-sm font-medium mb-1">Pending Payments</p>
                <p class="text-3xl font-bold text-gray-800">{{ $pendingBookings }}</p>
                <p class="text-xs text-gray-500 mt-2">Requires attention</p>
            </div>
            <div class="icon-container">
                <i class="fas fa-clock text-white text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions & Today's Stats -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Quick Actions -->
    <div class="quick-action-card">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-bolt text-white"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-800">Quick Actions</h3>
        </div>
        <div class="space-y-2">
            <a href="{{ route('admin.qr-scanner') }}" 
               class="action-item bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 text-blue-700">
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-qrcode text-white"></i>
                </div>
                <div>
                    <span class="font-medium">Scan QR Code</span>
                    <p class="text-sm text-blue-600">Verify customer tickets</p>
                </div>
            </a>
            <a href="#" class="action-item bg-gradient-to-r from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 text-green-700">
                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-plus text-white"></i>
                </div>
                <div>
                    <span class="font-medium">Add New Movie</span>
                    <p class="text-sm text-green-600">Expand your catalog</p>
                </div>
            </a>
            <a href="#" class="action-item bg-gradient-to-r from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 text-purple-700">
                <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-calendar-plus text-white"></i>
                </div>
                <div>
                    <span class="font-medium">Create Schedule</span>
                    <p class="text-sm text-purple-600">Plan movie showtimes</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Today's Overview -->
    <div class="lg:col-span-2 quick-action-card">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-calendar-day text-white"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-800">Today's Overview</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl">
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-ticket-alt text-white"></i>
                </div>
                <div class="text-2xl font-bold text-blue-600">
                    {{ $recentBookings->where('created_at', '>=', today())->count() }}
                </div>
                <p class="text-blue-700 text-sm font-medium">Today's Bookings</p>
            </div>
            <div class="text-center p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-xl">
                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-money-bill-wave text-white"></i>
                </div>
                <div class="text-2xl font-bold text-green-600">
                    Rp {{ number_format($recentBookings->where('created_at', '>=', today())->sum(function($booking) {
                        return $booking->schedule->price * $booking->seats->count();
                    }), 0, ',', '.') }}
                </div>
                <p class="text-green-700 text-sm font-medium">Today's Revenue</p>
            </div>
            <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl">
                <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-couch text-white"></i>
                </div>
                <div class="text-2xl font-bold text-purple-600">
                    {{ $recentBookings->where('created_at', '>=', today())->sum(function($booking) {
                        return $booking->seats->count();
                    }) }}
                </div>
                <p class="text-purple-700 text-sm font-medium">Seats Sold</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="table-container">
    <div class="table-header p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-history text-white"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Recent Bookings</h3>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50/50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Movie</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Cinema</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Showtime</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Seats</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recentBookings as $booking)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-semibold text-sm">{{ substr($booking->customer_name, 0, 1) }}</span>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ $booking->customer_name }}</div>
                                <div class="text-sm text-gray-500">{{ $booking->customer_phone }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $booking->schedule->movie->title }}</div>
                        <div class="text-sm text-gray-500">{{ $booking->schedule->movie->duration_minutes }} min</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $booking->schedule->studio->cinema->name }}</div>
                        <div class="text-sm text-gray-500">{{ $booking->schedule->studio->name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $booking->schedule->start_time->format('M j, Y') }}</div>
                        <div class="text-sm text-gray-500">{{ $booking->schedule->start_time->format('H:i') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($booking->seats as $seat)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-medium">
                                    {{ $seat->row }}{{ $seat->number }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="status-badge
                            @if($booking->status === 'pending_payment') bg-yellow-100 text-yellow-800
                            @elseif($booking->status === 'paid') bg-green-100 text-green-800
                            @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-semibold text-gray-900">
                            Rp {{ number_format($booking->schedule->price * $booking->seats->count(), 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <button onclick="showBookingDetails('{{ $booking->unique_code }}')"
                                    class="text-blue-600 hover:text-blue-800 transition-colors p-2 hover:bg-blue-50 rounded-lg"
                                    title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button onclick="scanQrCode('{{ $booking->unique_code }}')"
                                    class="text-green-600 hover:text-green-800 transition-colors p-2 hover:bg-green-50 rounded-lg"
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
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-ticket-alt text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">No recent bookings found</p>
                            <p class="text-gray-400 text-sm">New bookings will appear here</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Booking Details Modal -->
<div id="bookingModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden overflow-y-auto h-full w-full z-50 transition-opacity duration-300">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-2xl rounded-2xl bg-white">
        <div class="flex justify-between items-center mb-6 pb-4 border-b">
            <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-ticket-alt text-white"></i>
                </div>
                Booking Details
            </h3>
            <button onclick="closeBookingModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-100 rounded-lg">
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
        `<span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full font-medium mr-1">${seat.row}${seat.number}</span>`
    ).join('');

    const detailsHtml = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl">
                <h4 class="font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user mr-2 text-blue-600"></i>Customer Information
                </h4>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Name:</span>
                        <span class="font-medium">${booking.customer_name}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Phone:</span>
                        <span class="font-medium">${booking.customer_phone}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Code:</span>
                        <span class="font-mono text-sm bg-white px-2 py-1 rounded">${booking.unique_code}</span>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl">
                <h4 class="font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-film mr-2 text-green-600"></i>Movie & Schedule
                </h4>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Movie:</span>
                        <span class="font-medium">${booking.schedule.movie.title}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Cinema:</span>
                        <span class="font-medium">${booking.schedule.studio.cinema.name}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Studio:</span>
                        <span class="font-medium">${booking.schedule.studio.name}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Showtime:</span>
                        <span class="font-medium">${new Date(booking.schedule.start_time).toLocaleString()}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl">
            <h4 class="font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-couch mr-2 text-purple-600"></i>Seats & Payment
            </h4>
            <div class="space-y-4">
                <div>
                    <span class="text-gray-600 block mb-2">Selected Seats:</span>
                    <div>${seatsHtml}</div>
                </div>
                <div class="flex justify-between items-center pt-4 border-t border-purple-200">
                    <span class="text-gray-600">Total Amount:</span>
                    <span class="text-xl font-bold text-green-600">Rp ${(booking.schedule.price * booking.seats.length).toLocaleString('id-ID')}</span>
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