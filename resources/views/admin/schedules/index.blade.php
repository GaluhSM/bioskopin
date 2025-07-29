@extends('layouts.admin')

@section('title', 'Schedules Management')
@section('page-title', 'Schedules')

@push('styles')
<style>
    .schedules-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }

    .schedule-card {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .schedule-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #f59e0b, #d97706);
    }
    
    .schedule-card:hover {
        background: #243447;
        border-color: #4b5563;
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
    }
    
    .schedule-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    
    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    
    .action-btn:hover {
        transform: translateY(-1px);
    }
    
    .add-schedule-btn {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        font-weight: 600;
    }
    
    .add-schedule-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
    }
    
    .price-badge {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }
    
    .time-badge {
        background: #374151;
        color: #e5e7eb;
        padding: 6px 10px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }
    
    .status-indicator {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        z-index: 10;
    }
    
    .status-upcoming { background: #10b981; }
    .status-active { background: #f59e0b; }
    .status-ended { background: #6b7280; }
    
    .movie-poster {
        position: absolute;
        top: 0;
        right: 0;
        width: 80px;
        height: 100px;
        border-radius: 0 20px 0 16px;
        overflow: hidden;
        opacity: 0.3;
    }
    
    .poster-placeholder {
        background: linear-gradient(135deg, #374151 0%, #4b5563 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }
    
    .data-table {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-top: 32px;
    }
    
    .table-header {
        background: #111827;
        padding: 24px;
        border-bottom: 1px solid #374151;
    }
    
    .view-toggle {
        background: #374151;
        border-radius: 12px;
        padding: 4px;
        display: inline-flex;
        margin-bottom: 20px;
    }
    
    .toggle-btn {
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.2s ease;
        cursor: pointer;
        color: #9ca3af;
        font-weight: 500;
        font-size: 14px;
    }
    
    .toggle-btn.active {
        background: #3b82f6;
        color: white;
    }
</style>
@endpush

@section('content')
<div class="schedules-container">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-calendar-alt text-white text-xl"></i>
                </div>
                Schedules Management
            </h1>
            <p class="text-gray-400 mt-2">Manage movie schedules and showtimes</p>
        </div>
        <a href="{{ route('admin.schedules.create') }}" class="add-schedule-btn">
            <i class="fas fa-plus mr-2"></i>Add New Schedule
        </a>
    </div>

    <!-- View Toggle -->
    <div class="view-toggle">
        <div class="toggle-btn active" onclick="toggleView('cards')">
            <i class="fas fa-th mr-2"></i>Cards View
        </div>
        <div class="toggle-btn" onclick="toggleView('table')">
            <i class="fas fa-list mr-2"></i>Table View
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 text-green-800 px-6 py-4 rounded-xl mb-6 flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error') || $errors->any())
        <div class="bg-gradient-to-r from-red-50 to-red-100 border border-red-200 text-red-800 px-6 py-4 rounded-xl mb-6 flex items-center">
            <i class="fas fa-exclamation-triangle text-red-500 mr-3 text-lg"></i>
            <span class="font-medium">
                {{ session('error') ?: $errors->first() }}
            </span>
        </div>
    @endif

    <!-- Cards View -->
    <div id="cards-view">
        @if($schedules && $schedules->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($schedules as $schedule)
                <div class="schedule-card">
                    <!-- Status Indicator -->
                    @php
                        $now = now();
                        $status = 'upcoming';
                        if ($now->between($schedule->start_time, $schedule->end_time)) {
                            $status = 'active';
                        } elseif ($now->gt($schedule->end_time)) {
                            $status = 'ended';
                        }
                    @endphp
                    <div class="status-indicator status-{{ $status }}" 
                         title="{{ ucfirst($status) }}"></div>
                    
                    <!-- Movie Poster (if available) -->
                    @if($schedule->movie->poster_url)
                        <div class="movie-poster">
                            <img class="w-full h-full object-cover" 
                                 src="{{ $schedule->movie->poster_url }}" 
                                 alt="{{ $schedule->movie->title }}">
                        </div>
                    @else
                        <div class="movie-poster">
                            <div class="poster-placeholder">
                                <i class="fas fa-film text-gray-500 text-lg"></i>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Schedule Icon -->
                    <div class="schedule-icon">
                        <i class="fas fa-calendar-alt text-white text-2xl"></i>
                    </div>
                    
                    <!-- Schedule Info -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-white mb-2 line-clamp-1 pr-20">{{ $schedule->movie->title }}</h3>
                        
                        <!-- Cinema & Studio Info -->
                        <div class="text-sm text-gray-300 mb-3">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-building mr-2 text-gray-400"></i>
                                <span>{{ $schedule->studio->cinema->name }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-door-open mr-2 text-gray-400"></i>
                                <span>{{ $schedule->studio->name }}</span>
                            </div>
                        </div>
                        
                        <!-- Date & Time -->
                        <div class="mb-4">
                            <div class="text-white font-semibold mb-2">
                                {{ $schedule->start_time->format('l, M j, Y') }}
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="time-badge">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $schedule->start_time->format('H:i') }}
                                </span>
                                <span class="text-gray-400">-</span>
                                <span class="time-badge">
                                    {{ $schedule->end_time->format('H:i') }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Price & Duration -->
                        <div class="flex items-center justify-between">
                            <span class="price-badge">
                                <i class="fas fa-money-bill-wave mr-1"></i>
                                Rp {{ number_format($schedule->price, 0, ',', '.') }}
                            </span>
                            <span class="text-xs text-gray-400">
                                {{ $schedule->movie->duration_minutes }} min
                            </span>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex items-center justify-center space-x-3 pt-6 border-t border-gray-600">
                        <a href="{{ route('admin.schedules.show', $schedule) }}" 
                           class="action-btn bg-blue-700 text-blue-300 hover:bg-blue-600" 
                           title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.schedules.edit', $schedule) }}" 
                           class="action-btn bg-indigo-700 text-indigo-300 hover:bg-indigo-600" 
                           title="Edit Schedule">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.schedules.destroy', $schedule) }}" 
                              method="POST" class="inline" 
                              onsubmit="return confirm('Are you sure? This will delete the schedule and may affect existing bookings.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="action-btn bg-red-700 text-red-300 hover:bg-red-600" 
                                    title="Delete Schedule">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($schedules->hasPages())
                <div class="mt-8 flex justify-center">
                    <div class="bg-gray-800 rounded-xl p-4 shadow-lg">
                        {{ $schedules->links() }}
                    </div>
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-32 h-32 bg-gradient-to-br from-gray-700 to-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-calendar-alt text-gray-400 text-5xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">No Schedules Found</h3>
                <p class="text-gray-400 mb-8 max-w-md mx-auto">
                    Start by creating your first movie schedule. You can manage showtimes and cinema schedules from here.
                </p>
                <a href="{{ route('admin.schedules.create') }}" class="add-schedule-btn inline-flex">
                    <i class="fas fa-plus mr-2"></i>Create Your First Schedule
                </a>
            </div>
        @endif
    </div>

    <!-- Table View -->
    <div id="table-view" class="hidden">
        @if($schedules && $schedules->count() > 0)
            <div class="data-table">
                <div class="table-header">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-orange-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-list text-white"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-white">All Schedules</h3>
                        </div>
                        <span class="text-sm text-gray-400">{{ $schedules->total() }} total schedules</span>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-800">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Movie</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Cinema & Studio</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Date & Time</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-600">
                            @foreach($schedules as $schedule)
                            <tr class="hover:bg-gray-800 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-12 h-16 bg-gray-600 rounded-lg overflow-hidden mr-4 flex-shrink-0">
                                            @if($schedule->movie->poster_url)
                                                <img class="w-full h-full object-cover" 
                                                     src="{{ $schedule->movie->poster_url }}" 
                                                     alt="{{ $schedule->movie->title }}">
                                            @else
                                                <div class="w-full h-full bg-gray-700 flex items-center justify-center">
                                                    <i class="fas fa-film text-gray-400"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-white">{{ $schedule->movie->title }}</div>
                                            <div class="text-sm text-gray-400">{{ $schedule->movie->duration_minutes }} min</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-white">{{ $schedule->studio->cinema->name }}</div>
                                    <div class="text-sm text-gray-400">{{ $schedule->studio->name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-white">{{ $schedule->start_time->format('M j, Y') }}</div>
                                    <div class="text-sm text-gray-400">
                                        {{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }} WIB
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-green-400">
                                        Rp {{ number_format($schedule->price, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $now = now();
                                        $status = 'upcoming';
                                        $statusClass = 'bg-blue-900 text-blue-300';
                                        if ($now->between($schedule->start_time, $schedule->end_time)) {
                                            $status = 'active';
                                            $statusClass = 'bg-yellow-900 text-yellow-300';
                                        } elseif ($now->gt($schedule->end_time)) {
                                            $status = 'ended';
                                            $statusClass = 'bg-gray-700 text-gray-300';
                                        }
                                    @endphp
                                    <span class="px-3 py-1 text-xs rounded-full font-semibold {{ $statusClass }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.schedules.show', $schedule) }}" 
                                           class="text-blue-400 hover:text-blue-300 p-2 hover:bg-gray-700 rounded-lg transition-colors"
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.schedules.edit', $schedule) }}" 
                                           class="text-indigo-400 hover:text-indigo-300 p-2 hover:bg-gray-700 rounded-lg transition-colors"
                                           title="Edit Schedule">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.schedules.destroy', $schedule) }}" 
                                              method="POST" class="inline" 
                                              onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-400 hover:text-red-300 p-2 hover:bg-gray-700 rounded-lg transition-colors"
                                                    title="Delete Schedule">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination for Table View -->
                @if($schedules->hasPages())
                    <div class="p-6 border-t border-gray-600">
                        <div class="flex justify-center">
                            {{ $schedules->links() }}
                        </div>
                    </div>
                @endif
            </div>
        @else
            <!-- Empty State for Table View -->
            <div class="text-center py-16">
                <div class="w-32 h-32 bg-gradient-to-br from-gray-700 to-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-calendar-alt text-gray-400 text-5xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">No Schedules Found</h3>
                <p class="text-gray-400 mb-8 max-w-md mx-auto">
                    Start by creating your first movie schedule. You can manage showtimes and cinema schedules from here.
                </p>
                <a href="{{ route('admin.schedules.create') }}" class="add-schedule-btn inline-flex">
                    <i class="fas fa-plus mr-2"></i>Create Your First Schedule
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleView(viewType) {
    const cardsView = document.getElementById('cards-view');
    const tableView = document.getElementById('table-view');
    const toggleBtns = document.querySelectorAll('.toggle-btn');
    
    // Remove active class from all buttons
    toggleBtns.forEach(btn => btn.classList.remove('active'));
    
    if (viewType === 'cards') {
        cardsView.classList.remove('hidden');
        tableView.classList.add('hidden');
        toggleBtns[0].classList.add('active');
    } else {
        cardsView.classList.add('hidden');
        tableView.classList.remove('hidden');
        toggleBtns[1].classList.add('active');
    }
}
</script>
@endpush