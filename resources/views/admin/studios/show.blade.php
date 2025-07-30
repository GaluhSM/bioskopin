@extends('layouts.admin')

@section('title', 'Studio Details - ' . $studio->name)
@section('page-title', 'Studio Details')

@push('styles')
<style>
    .studio-container {
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
        margin-bottom: 32px;
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
        background: linear-gradient(90deg, #8b5cf6, #7c3aed);
    }
    
    .studio-header {
        display: flex;
        align-items: center;
        margin-bottom: 32px;
    }
    
    .studio-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 24px;
        flex-shrink: 0;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .info-item {
        background: #374151;
        padding: 20px;
        border-radius: 16px;
        border: 1px solid #4b5563;
    }
    
    .info-label {
        color: #9ca3af;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }
    
    .info-value {
        color: #ffffff;
        font-size: 1.125rem;
        font-weight: 600;
    }
    
    .seat-layout {
        background: #111827;
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 32px;
    }
    
    .screen {
        background: linear-gradient(135deg, #374151, #4b5563);
        height: 8px;
        border-radius: 4px;
        margin: 0 auto 32px;
        position: relative;
        max-width: 80%;
    }
    
    .screen::after {
        content: 'SCREEN';
        position: absolute;
        top: -24px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.75rem;
        color: #9ca3af;
        font-weight: 600;
        letter-spacing: 2px;
    }
    
    .seats-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }
    
    .seat-row {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .row-label {
        font-weight: 600;
        color: #9ca3af;
        width: 24px;
        text-align: center;
        font-size: 0.875rem;
    }
    
    .seat {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 500;
        background: #374151;
        color: #9ca3af;
        border: 1px solid #4b5563;
        transition: all 0.2s ease;
    }
    
    .seat:hover {
        background: #4b5563;
        border-color: #6b7280;
        transform: scale(1.05);
    }
    
    .action-buttons {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
    }
    
    .btn-secondary {
        background: #374151;
        color: #d1d5db;
        border: 1px solid #4b5563;
    }
    
    .btn-secondary:hover {
        background: #4b5563;
        border-color: #6b7280;
        transform: translateY(-1px);
    }
    
    .btn-danger {
        background: #dc2626;
        color: white;
    }
    
    .btn-danger:hover {
        background: #b91c1c;
        transform: translateY(-1px);
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }
    
    .stat-card {
        background: #374151;
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        border: 1px solid #4b5563;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #8b5cf6;
        margin-bottom: 8px;
    }
    
    .stat-label {
        color: #9ca3af;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .breadcrumb {
        display: flex;
        align-items: center;
        margin-bottom: 32px;
        color: #9ca3af;
        font-size: 0.875rem;
    }
    
    .breadcrumb a {
        color: #8b5cf6;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    
    .breadcrumb a:hover {
        color: #7c3aed;
    }
    
    .legend {
        display: flex;
        justify-content: center;
        gap: 24px;
        margin-top: 20px;
        flex-wrap: wrap;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.875rem;
        color: #9ca3af;
    }
    
    .legend-seat {
        width: 20px;
        height: 20px;
        border-radius: 6px;
        flex-shrink: 0;
    }
    
    @media (max-width: 768px) {
        .seat {
            width: 24px;
            height: 24px;
            font-size: 0.625rem;
        }
        
        .seats-container {
            gap: 8px;
        }
        
        .seat-row {
            gap: 4px;
        }
        
        .studio-header {
            flex-direction: column;
            text-align: center;
        }
        
        .studio-header h1 {
            margin-top: 16px;
        }
    }
</style>
@endpush

@section('content')
<div class="studio-container">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="mx-2">›</span>
        <a href="{{ route('admin.studios.index') }}">Studios</a>
        <span class="mx-2">›</span>
        <span class="text-white">{{ $studio->name }}</span>
    </nav>

    <!-- Studio Header -->
    <div class="detail-card">
        <div class="studio-header">
            <div class="studio-icon">
                <i class="fas fa-door-open text-white text-3xl"></i>
            </div>
            <div>
                <h1 class="text-4xl font-bold text-white mb-2">{{ $studio->name }}</h1>
                <p class="text-gray-400 text-lg">{{ $studio->cinema->name }}</p>
                <p class="text-gray-500 text-sm mt-1">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    {{ $studio->cinema->location }}
                </p>
            </div>
        </div>

        <!-- Studio Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $studio->capacity }}</div>
                <div class="stat-label">Total Capacity</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $studio->seats->count() }}</div>
                <div class="stat-label">Generated Seats</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $studio->seats->groupBy('row')->count() }}</div>
                <div class="stat-label">Rows</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $studio->schedules()->count() ?? 0 }}</div>
                <div class="stat-label">Active Schedules</div>
            </div>
        </div>

        <!-- Studio Information -->
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">
                    <i class="fas fa-building mr-2"></i>
                    Cinema
                </div>
                <div class="info-value">{{ $studio->cinema->name }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">
                    <i class="fas fa-door-open mr-2"></i>
                    Studio Name
                </div>
                <div class="info-value">{{ $studio->name }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">
                    <i class="fas fa-users mr-2"></i>
                    Capacity
                </div>
                <div class="info-value">{{ $studio->capacity }} people</div>
            </div>
            <div class="info-item">
                <div class="info-label">
                    <i class="fas fa-calendar mr-2"></i>
                    Created
                </div>
                <div class="info-value">{{ $studio->created_at->format('M d, Y') }}</div>
            </div>
        </div>
    </div>

    <!-- Seat Layout -->
    @if($studio->seats->count() > 0)
    <div class="detail-card">
        <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
            <i class="fas fa-couch text-purple-500 mr-3"></i>
            Seating Layout
        </h2>
        
        <div class="seat-layout">
            <!-- Screen -->
            <div class="screen"></div>
            
            <!-- Seats -->
            <div class="seats-container">
                @php
                    $seatsByRow = $studio->seats->groupBy('row');
                @endphp
                
                @foreach($seatsByRow as $row => $seats)
                <div class="seat-row">
                    <div class="row-label">{{ $row }}</div>
                    @foreach($seats->sortBy('number') as $seat)
                    <div class="seat" title="Seat {{ $row }}{{ $seat->number }}">
                        {{ $seat->number }}
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
            
            <!-- Legend -->
            <div class="legend">
                <div class="legend-item">
                    <div class="legend-seat" style="background: #374151; border: 1px solid #4b5563;"></div>
                    <span>Available Seat</span>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Schedules -->
    @if($studio->schedules && $studio->schedules->count() > 0)
    <div class="detail-card">
        <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
            <i class="fas fa-calendar-alt text-amber-500 mr-3"></i>
            Recent Schedules
        </h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Movie</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date & Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-600">
                    @foreach($studio->schedules->take(5) as $schedule)
                    <tr class="hover:bg-gray-800 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-12 bg-gray-600 rounded-lg overflow-hidden mr-3 flex-shrink-0">
                                    @if($schedule->movie->poster_url)
                                        <img class="w-full h-full object-cover" 
                                             src="{{ $schedule->movie->poster_url }}" 
                                             alt="{{ $schedule->movie->title }}">
                                    @else
                                        <div class="w-full h-full bg-gray-700 flex items-center justify-center">
                                            <i class="fas fa-film text-gray-400 text-xs"></i>
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
                            <div class="text-sm text-white">{{ $schedule->start_time->format('M j, Y') }}</div>
                            <div class="text-sm text-gray-400">
                                {{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }}
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($studio->schedules->count() > 5)
        <div class="mt-4 text-center">
            <a href="{{ route('admin.schedules.index') }}?studio={{ $studio->id }}" 
               class="text-purple-400 hover:text-purple-300 text-sm font-medium">
                View all schedules for this studio →
            </a>
        </div>
        @endif
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="detail-card">
        <div class="action-buttons">
            <a href="{{ route('admin.studios.edit', $studio) }}" class="btn btn-primary">
                <i class="fas fa-edit mr-2"></i>Edit Studio
            </a>
            <a href="{{ route('admin.studios.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Back to Studios
            </a>
            <form action="{{ route('admin.studios.destroy', $studio) }}" method="POST" class="inline" 
                  onsubmit="return confirm('Are you sure? This will also delete all seats and schedules in this studio.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash mr-2"></i>Delete Studio
                </button>
            </form>
        </div>
    </div>
</div>
@endsection