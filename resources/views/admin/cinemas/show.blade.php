@extends('layouts.admin')

@section('title', 'Cinema Details')
@section('page-title', 'Cinema Details')

@push('styles')
<style>
    .details-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }

    .detail-card {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
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
        background: linear-gradient(90deg, #667eea, #764ba2);
    }
    
    .header-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
    }
    
    .breadcrumb {
        display: flex;
        align-items: center;
        margin-bottom: 32px;
        font-size: 0.875rem;
    }
    
    .breadcrumb a {
        color: #9ca3af;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    
    .breadcrumb a:hover {
        color: #667eea;
    }
    
    .breadcrumb span {
        color: #6b7280;
        margin: 0 8px;
    }
    
    .breadcrumb .current {
        color: #f9fafb;
        font-weight: 500;
    }
    
    .action-btn {
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        font-weight: 600;
        font-size: 0.875rem;
        border: none;
        cursor: pointer;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }
    
    .btn-secondary {
        background: #374151;
        color: #d1d5db;
        margin-right: 12px;
    }
    
    .btn-secondary:hover {
        background: #4b5563;
        color: #f9fafb;
        transform: translateY(-1px);
    }
    
    .btn-danger {
        background: #7f1d1d;
        color: #fca5a5;
        margin-left: 12px;
    }
    
    .btn-danger:hover {
        background: #991b1b;
        color: #fecaca;
        transform: translateY(-1px);
    }
    
    .info-row {
        display: flex;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid #374151;
    }
    
    .info-row:last-child {
        border-bottom: none;
    }
    
    .info-label {
        flex: 0 0 160px;
        color: #9ca3af;
        font-size: 0.875rem;
        font-weight: 500;
        display: flex;
        align-items: center;
    }
    
    .info-value {
        flex: 1;
        color: #f9fafb;
        font-size: 0.875rem;
    }
    
    .studio-card {
        background: #374151;
        border: 1px solid #4b5563;
        border-radius: 16px;
        padding: 20px;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .studio-card:hover {
        background: #4b5563;
        border-color: #6b7280;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .studio-header {
        display: flex;
        align-items: center;
        justify-content: between;
        margin-bottom: 16px;
    }
    
    .studio-name {
        font-size: 1.125rem;
        font-weight: 600;
        color: #f9fafb;
        margin-bottom: 4px;
    }
    
    .studio-type {
        font-size: 0.75rem;
        color: #9ca3af;
        text-transform: uppercase;
        font-weight: 500;
    }
    
    .seats-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid #4b5563;
    }
    
    .seats-count {
        display: flex;
        align-items: center;
        color: #667eea;
        font-size: 0.875rem;
        font-weight: 600;
    }
    
    .studio-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .studio-action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }
    
    .studio-action-btn:hover {
        transform: translateY(-1px);
    }
    
    .btn-view {
        background: #1e40af;
        color: #93c5fd;
    }
    
    .btn-view:hover {
        background: #1d4ed8;
        color: #dbeafe;
    }
    
    .btn-edit {
        background: #7c2d12;
        color: #fdba74;
    }
    
    .btn-edit:hover {
        background: #9a3412;
        color: #fed7aa;
    }
    
    .empty-state {
        text-align: center;
        padding: 48px 24px;
        background: #374151;
        border-radius: 16px;
        border: 2px dashed #4b5563;
    }
    
    .empty-icon {
        width: 80px;
        height: 80px;
        background: #4b5563;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
</style>
@endpush

@section('content')
<div class="details-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">
            <i class="fas fa-home mr-1"></i>Dashboard
        </a>
        <span>/</span>
        <a href="{{ route('admin.cinemas.index') }}">Cinemas</a>
        <span>/</span>
        <span class="current">{{ $cinema->name }}</span>
    </div>

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center">
            <div class="header-icon">
                <i class="fas fa-building text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-white">{{ $cinema->name }}</h1>
                <p class="text-gray-400 mt-1">Cinema details and studio management</p>
            </div>
        </div>
        <div class="flex items-center">
            <a href="{{ route('admin.cinemas.index') }}" class="action-btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
            <a href="{{ route('admin.cinemas.edit', $cinema) }}" class="action-btn btn-primary">
                <i class="fas fa-edit mr-2"></i>Edit Cinema
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 text-green-800 px-6 py-4 rounded-xl mb-6 flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Cinema Details Card -->
    <div class="detail-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-info-circle text-blue-400 mr-3"></i>
                Cinema Information
            </h2>
            <span class="text-xs text-gray-400">
                Created {{ $cinema->created_at->format('F j, Y \a\t g:i A') }}
            </span>
        </div>

        <div class="space-y-0">
            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-building mr-2 text-gray-400"></i>
                    Cinema Name
                </div>
                <div class="info-value font-semibold">{{ $cinema->name }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                    Location
                </div>
                <div class="info-value">{{ $cinema->location }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-door-open mr-2 text-gray-400"></i>
                    Total Studios
                </div>
                <div class="info-value">
                    <span class="bg-blue-900 text-blue-200 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $cinema->studios->count() }} Studios
                    </span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-chair mr-2 text-gray-400"></i>
                    Total Seats
                </div>
                <div class="info-value">
                    <span class="bg-purple-900 text-purple-200 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $cinema->studios->sum(fn($studio) => $studio->seats->count()) }} Seats
                    </span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">
                    <i class="fas fa-calendar mr-2 text-gray-400"></i>
                    Last Updated
                </div>
                <div class="info-value">{{ $cinema->updated_at->format('F j, Y \a\t g:i A') }}</div>
            </div>
        </div>
    </div>

    <!-- Studios Section -->
    <div class="detail-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-door-open text-purple-400 mr-3"></i>
                Studios ({{ $cinema->studios->count() }})
            </h2>
            <a href="{{ route('admin.studios.create') }}?cinema_id={{ $cinema->id }}" class="action-btn btn-primary">
                <i class="fas fa-plus mr-2"></i>Add Studio
            </a>
        </div>

        @if($cinema->studios && $cinema->studios->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($cinema->studios as $studio)
                <div class="studio-card">
                    <div class="studio-header">
                        <div class="flex-1">
                            <div class="studio-name">{{ $studio->name }}</div>
                            <div class="studio-type">{{ ucfirst($studio->type ?? 'Standard') }} Studio</div>
                        </div>
                        <div class="studio-actions">
                            <a href="{{ route('admin.studios.show', $studio) }}" 
                               class="studio-action-btn btn-view" 
                               title="View Studio">
                                <i class="fas fa-eye text-xs"></i>
                            </a>
                            <a href="{{ route('admin.studios.edit', $studio) }}" 
                               class="studio-action-btn btn-edit" 
                               title="Edit Studio">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Studio Details -->
                    <div class="text-sm text-gray-300 space-y-2">
                        @if($studio->capacity)
                        <div class="flex items-center">
                            <i class="fas fa-users mr-2 text-gray-400 w-4"></i>
                            <span>Capacity: {{ $studio->capacity }} people</span>
                        </div>
                        @endif
                        
                        @if($studio->description)
                        <div class="flex items-start">
                            <i class="fas fa-info-circle mr-2 text-gray-400 w-4 mt-0.5"></i>
                            <span class="text-xs">{{ Str::limit($studio->description, 60) }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Seats Info -->
                    <div class="seats-info">
                        <div class="seats-count">
                            <i class="fas fa-chair mr-2"></i>
                            {{ $studio->seats->count() }} Seats
                        </div>
                        <div class="text-xs text-gray-400">
                            Added {{ $studio->created_at->format('M j, Y') }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-door-open text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">No Studios Yet</h3>
                <p class="text-gray-400 text-sm mb-6 max-w-sm mx-auto">
                    This cinema doesn't have any studios yet. Add your first studio to start managing showtimes and bookings.
                </p>
                <a href="{{ route('admin.studios.create') }}?cinema_id={{ $cinema->id }}" class="action-btn btn-primary">
                    <i class="fas fa-plus mr-2"></i>Add First Studio
                </a>
            </div>
        @endif
    </div>

    <!-- Action Buttons -->
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <a href="{{ route('admin.cinemas.index') }}" class="action-btn btn-secondary">
                <i class="fas fa-list mr-2"></i>All Cinemas
            </a>
            <a href="{{ route('admin.cinemas.edit', $cinema) }}" class="action-btn btn-primary">
                <i class="fas fa-edit mr-2"></i>Edit Cinema
            </a>
        </div>
        
        <!-- Delete Form -->
        <form action="{{ route('admin.cinemas.destroy', $cinema) }}" 
              method="POST" 
              class="inline"
              onsubmit="return confirm('Are you sure you want to delete this cinema? This will also delete all studios and seats in this cinema.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="action-btn btn-danger">
                <i class="fas fa-trash mr-2"></i>Delete Cinema
            </button>
        </form>
    </div>

    <!-- Warning Note -->
    <div class="mt-6 bg-amber-900/20 border border-amber-800/30 rounded-xl p-4">
        <div class="flex items-start">
            <i class="fas fa-exclamation-triangle text-amber-400 mr-3 mt-0.5"></i>
            <div class="text-sm text-amber-200">
                <p class="font-semibold mb-1">Important Note</p>
                <p>Before deleting this cinema, make sure to cancel any active bookings and notify customers about schedule changes.</p>
            </div>
        </div>
    </div>
</div>
@endsection