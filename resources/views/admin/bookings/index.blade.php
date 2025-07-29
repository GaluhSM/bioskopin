@extends('layouts.admin')

@section('title', 'Bookings Management')
@section('page-title', 'Bookings')

@push('styles')
<style>
    .bookings-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }
    
    .filter-card {
        background: white;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(229, 231, 235, 0.5);
        margin-bottom: 24px;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(229, 231, 235, 0.5);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient);
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
    }
    .action-button {
        padding: 8px 12px;
        border-radius: 8px;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }
    .action-button:hover {
        transform: translateY(-1px);
    }
    .table-container {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(229, 231, 235, 0.5);
    }
</style>
@endpush

@section('content')
<div class="bookings-container">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-rose-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-ticket-alt text-white text-xl"></i>
                </div>
                Bookings Management
            </h1>
            <p class="text-gray-600 mt-2">Manage and track all customer bookings</p>
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

    <!-- Filters -->
    <div class="filter-card">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-filter text-white"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-800">Filter Bookings</h3>
        </div>
        
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    <option value="">All Status</option>
                    <option value="pending_payment" {{ request('status') == 'pending_payment' ? 'selected' : '' }}>Pending Payment</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Date</label>
                <input type="date" name="date" value="{{ request('date') }}" 
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Search</label>
                <input type="text" name="search" placeholder="Customer name, phone, or code" value="{{ request('search') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>
            <div class="flex items-end space-x-3">
                <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl font-medium transition-all hover:shadow-lg hover:-translate-y-0.5">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <a href="{{ route('admin.bookings.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-medium transition-all hover:shadow-lg hover:-translate-y-0.5">
                    <i class="fas fa-refresh mr-2"></i>Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card" style="--gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mr-4">
                    <i class="fas fa-ticket-alt text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Bookings</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $bookings ? $bookings->total() : 0 }}</p>
                    <p class="text-xs text-gray-500">All time records</p>
                </div>
            </div>
        </div>
        
        <div class="stat-card" style="--gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-2xl flex items-center justify-center mr-4">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Pending Payment</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $bookings ? $bookings->where('status', 'pending_payment')->count() : 0 }}</p>
                    <p class="text-xs text-gray-500">Requires attention</p>
                </div>
            </div>
        </div>
        
        <div class="stat-card" style="--gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mr-4">
                    <i class="fas fa-check text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Paid</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $bookings ? $bookings->where('status', 'paid')->count() : 0 }}</p>
                    <p class="text-xs text-gray-500">Completed bookings</p>
                </div>
            </div>
        </div>
        
        <div class="stat-card" style="--gradient: linear-gradient(135deg, #fc466b 0%, #3f5efb 100%);">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl flex items-center justify-center mr-4">
                    <i class="fas fa-times text-white text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Cancelled</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $bookings ? $bookings->where('status', 'cancelled')->count() : 0 }}</p>
                    <p class="text-xs text-gray-500">Cancelled orders</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="table-container">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-list text-white"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">All Bookings</h3>
                </div>
                <div class="text-sm text-gray-500">
                    @if($bookings && $bookings->count() > 0)
                        Showing {{ $bookings->firstItem() }}-{{ $bookings->lastItem() }} of {{ $bookings->total() }} results
                    @else
                        No results
                    @endif
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Movie</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Cinema</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Schedule</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Seats</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($bookings ?? [] as $booking)
                    <tr class="hover:bg-gray-50/50 transition-all">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white font-semibold">{{ substr($booking->customer_name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">{{ $booking->customer_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $booking->customer_phone }}</div>
                                    <div class="text-xs text-gray-400 font-mono bg-gray-100 px-2 py-1 rounded mt-1">{{ $booking->unique_code }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-gray-900">{{ $booking->schedule->movie->title }}</div>
                            <div class="text-sm text-gray-500 flex items-center mt-1">
                                <i class="fas fa-clock mr-1"></i>{{ $booking->schedule->movie->duration_minutes }} min
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $booking->schedule->studio->cinema->name }}</div>
                            <div class="text-sm text-gray-500 flex items-center mt-1">
                                <i class="fas fa-door-open mr-1"></i>{{ $booking->schedule->studio->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $booking->schedule->start_time->format('M j, Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $booking->schedule->start_time->format('H:i') }} WIB</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @foreach($booking->seats->take(3) as $seat)
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-medium">
                                        {{ $seat->row }}{{ $seat->number }}
                                    </span>
                                @endforeach
                                @if($booking->seats->count() > 3)
                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">+{{ $booking->seats->count() - 3 }} more</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900">
                                Rp {{ number_format($booking->schedule->price * $booking->seats->count(), 0, ',', '.') }}
                            </div>
                            <div class="text-xs text-gray-500">{{ $booking->seats->count() }} seats</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full
                                @if($booking->status === 'pending_payment') bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800
                                @elseif($booking->status === 'paid') bg-gradient-to-r from-green-100 to-green-200 text-green-800
                                @elseif($booking->status === 'cancelled') bg-gradient-to-r from-red-100 to-red-200 text-red-800
                                @else bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.bookings.show', $booking) }}" 
                                   class="action-button bg-blue-100 text-blue-700 hover:bg-blue-200" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                @if($booking->status === 'pending_payment')
                                    <form action="{{ route('admin.bookings.mark-paid', $booking) }}" 
                                          method="POST" class="inline" 
                                          onsubmit="return confirm('Mark this booking as paid?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="action-button bg-green-100 text-green-700 hover:bg-green-200" title="Mark as Paid">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.bookings.cancel', $booking) }}" 
                                          method="POST" class="inline" 
                                          onsubmit="return confirm('Cancel this booking?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="action-button bg-red-100 text-red-700 hover:bg-red-200" title="Cancel">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @endif
                                
                                <button onclick="scanQrCode('{{ $booking->unique_code }}')" 
                                        class="action-button bg-purple-100 text-purple-700 hover:bg-purple-200" title="View QR">
                                    <i class="fas fa-qrcode"></i>
                                </button>
                                
                                <form action="{{ route('admin.bookings.destroy', $booking) }}" 
                                      method="POST" class="inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this booking?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-button bg-gray-100 text-gray-700 hover:bg-gray-200" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-ticket-alt text-gray-400 text-3xl"></i>
                                </div>
                                <p class="text-gray-500 font-semibold text-lg">No bookings found</p>
                                <p class="text-gray-400">Try adjusting your search criteria</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($bookings && $bookings->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $bookings->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function scanQrCode(uniqueCode) {
    window.location.href = `{{ route('admin.qr-scanner') }}?code=${uniqueCode}`;
}
</script>
@endpush
@endsection