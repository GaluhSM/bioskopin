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
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 24px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .stat-card {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
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
        height: 3px;
        background: var(--gradient);
    }
    
    .stat-card:hover {
        background: #243447;
        border-color: #4b5563;
        transform: translateY(-2px);
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
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
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
</style>
@endpush

@section('content')
<div class="bookings-container">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-rose-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-ticket-alt text-white text-xl"></i>
                </div>
                Bookings Management
            </h1>
            <p class="text-gray-400 mt-2">Manage and track all customer bookings</p>
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
            <h3 class="text-lg font-semibold text-white">Filter Bookings</h3>
        </div>
        
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-3 bg-gray-700 border border-gray-600 text-white rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    <option value="">All Status</option>
                    <option value="pending_payment" {{ request('status') == 'pending_payment' ? 'selected' : '' }}>Pending Payment</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Date</label>
                <input type="date" name="date" value="{{ request('date') }}" 
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 text-white rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Search</label>
                <input type="text" name="search" placeholder="Customer name, phone, or code" value="{{ request('search') }}"
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 text-white placeholder-gray-400 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            </div>
            <div class="flex items-end space-x-3">
                <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl font-medium transition-all hover:shadow-lg hover:-translate-y-0.5">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <a href="{{ route('admin.bookings.index') }}" class="bg-gray-700 hover:bg-gray-600 text-gray-300 px-6 py-3 rounded-xl font-medium transition-all hover:shadow-lg hover:-translate-y-0.5">
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
                    <p class="text-sm font-medium text-gray-400 mb-1">Total Bookings</p>
                    <p class="text-3xl font-bold text-white">{{ $bookings ? $bookings->total() : 0 }}</p>
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
                    <p class="text-sm font-medium text-gray-400 mb-1">Pending Payment</p>
                    <p class="text-3xl font-bold text-white">{{ $bookings ? $bookings->where('status', 'pending_payment')->count() : 0 }}</p>
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
                    <p class="text-sm font-medium text-gray-400 mb-1">Paid</p>
                    <p class="text-3xl font-bold text-white">{{ $bookings ? $bookings->where('status', 'paid')->count() : 0 }}</p>
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
                    <p class="text-sm font-medium text-gray-400 mb-1">Cancelled</p>
                    <p class="text-3xl font-bold text-white">{{ $bookings ? $bookings->where('status', 'cancelled')->count() : 0 }}</p>
                    <p class="text-xs text-gray-500">Cancelled orders</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="table-container">
        <div class="p-6 border-b border-gray-600">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-list text-white"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-white">All Bookings</h3>
                </div>
                <div class="text-sm text-gray-400">
                    @if($bookings && $bookings->count() > 0)
                        Showing {{ $bookings->firstItem() }}-{{ $bookings->lastItem() }} of {{ $bookings->total() }} results
                    @else
                        No results
                    @endif
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full table">
                <thead>
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Movie</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Cinema</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Schedule</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Seats</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings ?? [] as $booking)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white font-semibold">{{ substr($booking->customer_name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-white">{{ $booking->customer_name }}</div>
                                    <div class="text-sm text-gray-400">{{ $booking->customer_phone }}</div>
                                    <div class="text-xs text-gray-500 font-mono bg-gray-700 px-2 py-1 rounded mt-1">{{ $booking->unique_code }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-white">{{ $booking->schedule->movie->title }}</div>
                            <div class="text-sm text-gray-400 flex items-center mt-1">
                                <i class="fas fa-clock mr-1"></i>{{ $booking->schedule->movie->duration_minutes }} min
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-white">{{ $booking->schedule->studio->cinema->name }}</div>
                            <div class="text-sm text-gray-400 flex items-center mt-1">
                                <i class="fas fa-door-open mr-1"></i>{{ $booking->schedule->studio->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-white">{{ $booking->schedule->start_time->format('M j, Y') }}</div>
                            <div class="text-sm text-gray-400">{{ $booking->schedule->start_time->format('H:i') }} WIB</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @foreach($booking->seats->take(3) as $seat)
                                    <span class="inline-block bg-gray-700 text-gray-300 text-xs px-2 py-1 rounded-full font-medium">
                                        {{ $seat->row }}{{ $seat->number }}
                                    </span>
                                @endforeach
                                @if($booking->seats->count() > 3)
                                    <span class="text-xs text-gray-400 bg-gray-700 px-2 py-1 rounded-full">+{{ $booking->seats->count() - 3 }} more</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-white">
                                Rp {{ number_format($booking->schedule->price * $booking->seats->count(), 0, ',', '.') }}
                            </div>
                            <div class="text-xs text-gray-400">{{ $booking->seats->count() }} seats</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full
                                @if($booking->status === 'pending_payment') bg-yellow-900 text-yellow-300
                                @elseif($booking->status === 'paid') bg-green-900 text-green-300
                                @elseif($booking->status === 'cancelled') bg-red-900 text-red-300
                                @else bg-gray-700 text-gray-300 @endif">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.bookings.show', $booking) }}" 
                                   class="action-button bg-blue-700 text-blue-300 hover:bg-blue-600" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                @if($booking->status === 'pending_payment')
                                    <form action="{{ route('admin.bookings.mark-paid', $booking) }}" 
                                          method="POST" class="inline" 
                                          onsubmit="return confirm('Mark this booking as paid?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="action-button bg-green-700 text-green-300 hover:bg-green-600" title="Mark as Paid">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.bookings.cancel', $booking) }}" 
                                          method="POST" class="inline" 
                                          onsubmit="return confirm('Cancel this booking?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="action-button bg-red-700 text-red-300 hover:bg-red-600" title="Cancel">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @endif
                                
                                <button onclick="scanQrCode('{{ $booking->unique_code }}')" 
                                        class="action-button bg-purple-700 text-purple-300 hover:bg-purple-600" title="View QR">
                                    <i class="fas fa-qrcode"></i>
                                </button>
                                
                                <form action="{{ route('admin.bookings.destroy', $booking) }}" 
                                      method="POST" class="inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this booking?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-button bg-gray-700 text-gray-300 hover:bg-gray-600" title="Delete">
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
                                <div class="w-20 h-20 bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-ticket-alt text-gray-400 text-3xl"></i>
                                </div>
                                <p class="text-gray-300 font-semibold text-lg">No bookings found</p>
                                <p class="text-gray-500">Try adjusting your search criteria</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($bookings && $bookings->hasPages())
            <div class="px-6 py-4 border-t border-gray-600 bg-gray-800">
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