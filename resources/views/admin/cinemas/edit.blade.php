@extends('layouts.admin')

@section('title', 'Edit Cinema')
@section('page-title', 'Edit Cinema')

@push('styles')
<style>
    .form-container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        padding: 0;
    }

    .form-card {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }
    
    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #667eea, #764ba2);
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: block;
        color: #f9fafb;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .form-input {
        width: 100%;
        background: #374151;
        border: 1px solid #4b5563;
        border-radius: 12px;
        padding: 12px 16px;
        color: #f9fafb;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #667eea;
        background: #4b5563;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    .form-input.error {
        border-color: #ef4444;
        background: #450a0a;
    }
    
    .error-message {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 4px;
        display: flex;
        align-items: center;
    }
    
    .submit-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 14px 28px;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        font-weight: 600;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }
    
    .cancel-btn {
        background: #374151;
        color: #d1d5db;
        padding: 14px 28px;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        font-weight: 600;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
        margin-right: 16px;
    }
    
    .cancel-btn:hover {
        background: #4b5563;
        color: #f9fafb;
        transform: translateY(-1px);
    }
    
    .delete-btn {
        background: #7f1d1d;
        color: #fca5a5;
        padding: 14px 28px;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        font-weight: 600;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
        margin-left: 16px;
    }
    
    .delete-btn:hover {
        background: #991b1b;
        color: #fecaca;
        transform: translateY(-1px);
    }
    
    .header-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
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
    
    .info-card {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 16px;
        padding: 20px;
        margin-top: 24px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 16px;
        margin-top: 16px;
    }
    
    .stat-item {
        background: #374151;
        border-radius: 12px;
        padding: 16px;
        text-align: center;
    }
    
    .stat-value {
        font-size: 1.5rem;
        font-weight: bold;
        color: #667eea;
        margin-bottom: 4px;
    }
    
    .stat-label {
        font-size: 0.75rem;
        color: #9ca3af;
        font-weight: 500;
    }
</style>
@endpush

@section('content')
<div class="form-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">
            <i class="fas fa-home mr-1"></i>Dashboard
        </a>
        <span>/</span>
        <a href="{{ route('admin.cinemas.index') }}">Cinemas</a>
        <span>/</span>
        <span class="current">Edit {{ $cinema->name }}</span>
    </div>

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center">
            <div class="header-icon">
                <i class="fas fa-edit text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-white">Edit Cinema</h1>
                <p class="text-gray-400 mt-1">Update cinema information and settings</p>
            </div>
        </div>
        <a href="{{ route('admin.cinemas.show', $cinema) }}" class="text-blue-400 hover:text-blue-300 text-sm">
            <i class="fas fa-eye mr-1"></i>View Details
        </a>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('admin.cinemas.update', $cinema) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Cinema Name -->
            <div class="form-group">
                <label for="name" class="form-label">
                    <i class="fas fa-building mr-2 text-gray-400"></i>Cinema Name
                </label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       class="form-input {{ $errors->has('name') ? 'error' : '' }}" 
                       value="{{ old('name', $cinema->name) }}"
                       placeholder="Enter cinema name (e.g., CGV Grand Indonesia)"
                       required>
                @if($errors->has('name'))
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <!-- Location -->
            <div class="form-group">
                <label for="location" class="form-label">
                    <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>Location
                </label>
                <input type="text" 
                       id="location" 
                       name="location" 
                       class="form-input {{ $errors->has('location') ? 'error' : '' }}" 
                       value="{{ old('location', $cinema->location) }}"
                       placeholder="Enter cinema location (e.g., Jl. MH Thamrin No.1, Jakarta Pusat)"
                       required>
                @if($errors->has('location'))
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $errors->first('location') }}
                    </div>
                @endif
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-600">
                <div class="flex items-center">
                    <a href="{{ route('admin.cinemas.index') }}" class="cancel-btn">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-save mr-2"></i>Update Cinema
                    </button>
                </div>
                
                <!-- Delete Button -->
                <form action="{{ route('admin.cinemas.destroy', $cinema) }}" 
                      method="POST" 
                      class="inline"
                      onsubmit="return confirm('Are you sure you want to delete this cinema? This will also delete all studios and seats in this cinema.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">
                        <i class="fas fa-trash mr-2"></i>Delete Cinema
                    </button>
                </form>
            </div>
        </form>
    </div>

    <!-- Cinema Info -->
    <div class="info-card">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-white">Cinema Information</h3>
            <span class="text-xs text-gray-400">
                Created {{ $cinema->created_at->format('F j, Y \a\t g:i A') }}
            </span>
        </div>
        
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-value">{{ $cinema->studios_count ?? 0 }}</div>
                <div class="stat-label">Studios</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">{{ $cinema->created_at->diffInDays(now()) }}</div>
                <div class="stat-label">Days Active</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">{{ $cinema->updated_at->format('M j') }}</div>
                <div class="stat-label">Last Updated</div>
            </div>
        </div>
    </div>

    <!-- Warning Card -->
    <div class="mt-6 bg-amber-900/20 border border-amber-800/30 rounded-xl p-4">
        <div class="flex items-start">
            <i class="fas fa-exclamation-triangle text-amber-400 mr-3 mt-0.5"></i>
            <div class="text-sm text-amber-200">
                <p class="font-semibold mb-1">Warning</p>
                <p>Deleting this cinema will permanently remove all associated studios, seats, schedules, and booking data. This action cannot be undone.</p>
            </div>
        </div>
    </div>
</div>
@endsection