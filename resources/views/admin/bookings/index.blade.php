@extends('layouts.admin')

@section('title', 'Bookings Management')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Bookings Management</h1>
        <p class="text-gray-600">Manage all customer bookings</p>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ $errors->first() }}
    </div>
@endif

<!-- Filters -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form method="GET" action="{{ route('admin.bookings.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <option value="">All Status</option>
                <option value="pending_payment" {{ request('status') == 'pending_payment' ? 'selected' : '' }}>Pending Payment</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
            <input type="date" name="date" value="{{ request('date') }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <input type="text" name="search" placeholder="Customer name, phone, or code" value="{{ request('search') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="flex items-end space-x-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
            <a href="{{ route('admin.bookings.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-refresh mr-2"></i>Reset
            </a>
        </div>
    </form>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow p-4">
        <div class="flex items-center">
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-ticket-alt text-blue-600"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-gray-600">Total Bookings</p>
                <p class="text-xl font-bold">{{ $bookings->total() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <div class="flex items-center">
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-clock text-yellow-600"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-gray-600">Pending Payment</p>
                <p class="text-xl font-bold">{{ $bookings->where('status', 'pending_payment')->count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <div class="flex items-center">
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-check text-green-600"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-gray-600">Paid</p>
                <p class="text-xl font-bold">{{ $bookings->where('status', 'paid')->count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <div class="flex items-center">
            <div class="bg-red-100 p-3 rounded-full">
                <i class="fas fa-times text-red-600"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-gray-600">Cancelled</p>
                <p class="text-xl font-bold">{{ $bookings->where('status', 'cancelled')->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Bookings Table -->
<div class="bg-white rounded-lg shadow">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Movie</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cinema</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Schedule</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seats</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($bookings as $booking)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $booking->customer_name }}</div>
                            <div class="text-sm text-gray-500">{{ $booking->customer_phone }}</div>
                            <div class="text-xs text-gray-400 font-mono">{{ $booking->unique_code }}</div>
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
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $booking->schedule->start_time->format('M j, Y') }}</div>
                        <div class="text-sm text-gray-500">{{ $booking->schedule->start_time->format('H:i') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($booking->seats->take(3) as $seat)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                    {{ $seat->row }}{{ $seat->number }}
                                </span>
                            @endforeach
                            @if($booking->seats->count() > 3)
                                <span class="text-xs text-gray-500">+{{ $booking->seats->count() - 3 }} more</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            Rp {{ number_format($booking->schedule->price * $booking->seats->count(), 0, ',', '.') }}
                        </div>
                        <div class="text-xs text-gray-500">{{ $booking->seats->count() }} seats</div>
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
                    <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                        <a href="{{ route('admin.bookings.show', $booking) }}" 
                           class="text-blue-600 hover:text-blue-900" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        
                        @if($booking->status === 'pending_payment')
                            <form action="{{ route('admin.bookings.mark-paid', $booking) }}" 
                                  method="POST" class="inline" 
                                  onsubmit="return confirm('Mark this booking as paid?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-green-600 hover:text-green-900" title="Mark as Paid">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.bookings.cancel', $booking) }}" 
                                  method="POST" class="inline" 
                                  onsubmit="return confirm('Cancel this booking?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Cancel">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        @endif
                        
                        <button onclick="scanQrCode('{{ $booking->unique_code }}')" 
                                class="text-purple-600 hover:text-purple-900" title="View QR">
                            <i class="fas fa-qrcode"></i>
                        </button>
                        
                        <form action="{{ route('admin.bookings.destroy', $booking) }}" 
                              method="POST" class="inline" 
                              onsubmit="return confirm('Are you sure you want to delete this booking?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                        No bookings found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($bookings->hasPages())
        <div class="px-6 py-3 border-t border-gray-200">
            {{ $bookings->appends(request()->query())->links() }}
        </div>
    @endif
</div>

@push('scripts')
<script>
function scanQrCode(uniqueCode) {
    window.location.href = `{{ route('admin.qr-scanner') }}?code=${uniqueCode}`;
}
</script>
@endpush
@endsection