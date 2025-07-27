@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-600">Overview of your cinema management system</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Movies -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-film text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Total Movies</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalMovies }}</p>
            </div>
        </div>
    </div>

    <!-- Total Cinemas -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-building text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Total Cinemas</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalCinemas }}</p>
            </div>
        </div>
    </div>

    <!-- Total Bookings -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-ticket-alt text-purple-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Total Bookings</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalBookings }}</p>
            </div>
        </div>
    </div>

    <!-- Pending Payments -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-clock text-yellow-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600 text-sm">Pending Payments</p>
                <p class="text-2xl font-bold text-gray-800">{{ $pendingBookings }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
        <div class="space-y-3">
            <a href="{{ route('admin.qr-scanner') }}" 
               class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                <i class="fas fa-qrcode text-blue-600 mr-3"></i>
                <span class="text-gray-800">Scan QR Code</span>
            </a>
            <a href="#" class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                <i class="fas fa-plus text-green-600 mr-3"></i>
                <span class="text-gray-800">Add New Movie</span>
            </a>
            <a href="#" class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                <i class="fas fa-calendar-plus text-purple-600 mr-3"></i>
                <span class="text-gray-800">Create Schedule</span>
            </a>
        </div>
    </div>

    <!-- Today's Stats -->
    <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Today's Overview</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">
                    {{ $recentBookings->where('created_at', '>=', today())->count() }}
                </div>
                <p class="text-gray-600 text-sm">Today's Bookings</p>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600">
                    Rp {{ number_format($recentBookings->where('created_at', '>=', today())->sum(function($booking) {
                        return $booking->schedule->price * $booking->seats->count();
                    }), 0, ',', '.') }}
                </div>
                <p class="text-gray-600 text-sm">Today's Revenue</p>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-purple-600">
                    {{ $recentBookings->where('created_at', '>=', today())->sum(function($booking) {
                        return $booking->seats->count();
                    }) }}
                </div>
                <p class="text-gray-600 text-sm">Seats Sold</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Recent Bookings</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Movie</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cinema</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Showtime</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seats</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($recentBookings as $booking)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $booking->customer_name }}</div>
                            <div class="text-sm text-gray-500">{{ $booking->customer_phone }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $booking->schedule->movie->title }}</div>
                        <div class="text-sm text-gray-500">{{ $booking->schedule->movie->duration_minutes }} min</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $booking->schedule->studio->cinema->name }}</div>
                        <div class="text-sm text-gray-500">{{ $booking->schedule->studio->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $booking->schedule->start_time->format('M j, Y') }}</div>
                        <div class="text-sm text-gray-500">{{ $booking->schedule->start_time->format('H:i') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-wrap gap-1">
                            @foreach($booking->seats as $seat)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                    {{ $seat->row }}{{ $seat->number }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                            @if($booking->status === 'pending_payment') bg-yellow-100 text-yellow-800
                            @elseif($booking->status === 'paid') bg-green-100 text-green-800
                            @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        Rp {{ number_format($booking->schedule->price * $booking->seats->count(), 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <button onclick="showBookingDetails('{{ $booking->unique_code }}')"
                                class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button onclick="scanQrCode('{{ $booking->unique_code }}')"
                                class="text-green-600 hover:text-green-900">
                            <i class="fas fa-qrcode"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                        No recent bookings found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Booking Details Modal -->
<div id="bookingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Booking Details</h3>
            <button onclick="closeBookingModal()" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-times"></i>
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
        `<span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-1">${seat.row}${seat.number}</span>`
    ).join('');

    const detailsHtml = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h4 class="font-semibold text-gray-800 mb-2">Customer Information</h4>
                <p><span class="font-medium">Name:</span> ${booking.customer_name}</p>
                <p><span class="font-medium">Phone:</span> ${booking.customer_phone}</p>
                <p><span class="font-medium">Status:</span> 
                    <span class="px-2 py-1 text-xs rounded-full ${booking.status === 'pending_payment' ? 'bg-yellow-100 text-yellow-800' : booking.status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                        ${booking.status.replace('_', ' ').toUpperCase()}
                    </span>
                </p>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800 mb-2">Movie & Schedule</h4>
                <p><span class="font-medium">Movie:</span> ${booking.schedule.movie.title}</p>
                <p><span class="font-medium">Cinema:</span> ${booking.schedule.studio.cinema.name}</p>
                <p><span class="font-medium">Studio:</span> ${booking.schedule.studio.name}</p>
                <p><span class="font-medium">Showtime:</span> ${new Date(booking.schedule.start_time).toLocaleString()}</p>
            </div>
        </div>
        <div class="mt-4">
            <h4 class="font-semibold text-gray-800 mb-2">Seats</h4>
            <div>${seatsHtml}</div>
        </div>
        <div class="mt-4 p-4 bg-gray-50 rounded">
            <h4 class="font-semibold text-gray-800 mb-2">Payment Summary</h4>
            <p><span class="font-medium">Price per seat:</span> Rp ${booking.schedule.price.toLocaleString('id-ID')}</p>
            <p><span class="font-medium">Number of seats:</span> ${booking.seats.length}</p>
            <p class="text-lg font-bold text-green-600"><span class="font-medium">Total:</span> Rp ${(booking.schedule.price * booking.seats.length).toLocaleString('id-ID')}</p>
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