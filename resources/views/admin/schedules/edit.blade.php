@extends('layouts.admin')

@section('title', 'Edit Schedule')
@section('page-title', 'Edit Schedule')

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
        background: linear-gradient(90deg, #f59e0b, #d97706);
    }
    
    .form-header {
        text-align: center;
        margin-bottom: 32px;
    }
    
    .form-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: block;
        color: #e5e7eb;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .form-control {
        width: 100%;
        padding: 16px 20px;
        background: #374151;
        border: 1px solid #4b5563;
        border-radius: 12px;
        color: #ffffff;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #f59e0b;
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
        background: #4b5563;
    }
    
    .form-select {
        width: 100%;
        padding: 16px 20px;
        background: #374151;
        border: 1px solid #4b5563;
        border-radius: 12px;
        color: #ffffff;
        font-size: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .form-select:focus {
        outline: none;
        border-color: #f59e0b;
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
        background: #4b5563;
    }
    
    .form-select option {
        background: #374151;
        color: #ffffff;
        padding: 8px;
    }
    
    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 8px;
        display: flex;
        align-items: center;
    }
    
    .success-message {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        font-weight: 500;
    }
    
    .form-actions {
        display: flex;
        gap: 16px;
        justify-content: center;
        margin-top: 32px;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 16px 32px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        min-width: 140px;
        justify-content: center;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
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
    
    .input-group {
        position: relative;
    }
    
    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        z-index: 10;
    }
    
    .input-group .form-control,
    .input-group .form-select {
        padding-left: 48px;
    }
    
    .form-help {
        color: #9ca3af;
        font-size: 0.875rem;
        margin-top: 6px;
        display: flex;
        align-items: center;
    }
    
    .breadcrumb {
        display: flex;
        align-items: center;
        margin-bottom: 32px;
        color: #9ca3af;
        font-size: 0.875rem;
    }
    
    .breadcrumb a {
        color: #f59e0b;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    
    .breadcrumb a:hover {
        color: #d97706;
    }
    
    .current-info {
        background: #374151;
        border: 1px solid #4b5563;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
    }
    
    .current-info h3 {
        color: #f59e0b;
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }
    
    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #4b5563;
    }
    
    .info-item:last-child {
        border-bottom: none;
    }
    
    .info-label {
        color: #9ca3af;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .info-value {
        color: #ffffff;
        font-weight: 600;
    }
    
    @media (max-width: 768px) {
        .form-container {
            max-width: 100%;
            padding: 0 16px;
        }
        
        .form-card {
            padding: 24px 20px;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="form-container">
    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="mx-2">›</span>
        <a href="{{ route('admin.schedules.index') }}">Schedules</a>
        <span class="mx-2">›</span>
        <span class="text-white">Edit Schedule</span>
    </nav>

    <div class="form-card">
        <!-- Form Header -->
        <div class="form-header">
            <div class="form-icon">
                <i class="fas fa-edit text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Edit Schedule</h1>
            <p class="text-gray-400">Update movie schedule information</p>
        </div>

        <!-- Current Schedule Info -->
        <div class="current-info">
            <h3>
                <i class="fas fa-info-circle mr-2"></i>
                Current Schedule Information
            </h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Movie:</span>
                    <span class="info-value">{{ $schedule->movie->title }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Cinema:</span>
                    <span class="info-value">{{ $schedule->studio->cinema->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Studio:</span>
                    <span class="info-value">{{ $schedule->studio->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Start Time:</span>
                    <span class="info-value">{{ $schedule->start_time->format('M j, Y - H:i') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">End Time:</span>
                    <span class="info-value">{{ $schedule->end_time->format('M j, Y - H:i') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Price:</span>
                    <span class="info-value">Rp {{ number_format($schedule->price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="success-message">
                <i class="fas fa-check-circle mr-3 text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Edit Form -->
        <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Movie Selection -->
                <div class="form-group">
                    <label for="movie_id" class="form-label">
                        <i class="fas fa-film mr-2"></i>Movie
                    </label>
                    <div class="input-group">
                        <i class="fas fa-film input-icon"></i>
                        <select name="movie_id" id="movie_id" class="form-select @error('movie_id') border-red-500 @enderror" required>
                            <option value="">Select a movie</option>
                            @foreach($movies as $movie)
                                <option value="{{ $movie->id }}" {{ old('movie_id', $schedule->movie_id) == $movie->id ? 'selected' : '' }}>
                                    {{ $movie->title }} ({{ $movie->duration_minutes }} min)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('movie_id')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </div>
                    @enderror
                    <div class="form-help">
                        <i class="fas fa-info-circle mr-1"></i>
                        Select the movie for this schedule
                    </div>
                </div>

                <!-- Studio Selection -->
                <div class="form-group">
                    <label for="studio_id" class="form-label">
                        <i class="fas fa-door-open mr-2"></i>Studio
                    </label>
                    <div class="input-group">
                        <i class="fas fa-door-open input-icon"></i>
                        <select name="studio_id" id="studio_id" class="form-select @error('studio_id') border-red-500 @enderror" required>
                            <option value="">Select a studio</option>
                            @foreach($studios as $studio)
                                <option value="{{ $studio->id }}" {{ old('studio_id', $schedule->studio_id) == $studio->id ? 'selected' : '' }}>
                                    {{ $studio->cinema->name }} - {{ $studio->name }} ({{ $studio->capacity }} seats)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('studio_id')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </div>
                    @enderror
                    <div class="form-help">
                        <i class="fas fa-info-circle mr-1"></i>
                        Choose cinema and studio for this schedule
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Start Time -->
                <div class="form-group">
                    <label for="start_time" class="form-label">
                        <i class="fas fa-clock mr-2"></i>Start Date & Time
                    </label>
                    <div class="input-group">
                        <i class="fas fa-clock input-icon"></i>
                        <input type="datetime-local" 
                               name="start_time" 
                               id="start_time" 
                               class="form-control @error('start_time') border-red-500 @enderror"
                               value="{{ old('start_time', $schedule->start_time->format('Y-m-d\TH:i')) }}"
                               required>
                    </div>
                    @error('start_time')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </div>
                    @enderror
                    <div class="form-help">
                        <i class="fas fa-info-circle mr-1"></i>
                        When should this movie schedule start?
                    </div>
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label for="price" class="form-label">
                        <i class="fas fa-money-bill-wave mr-2"></i>Ticket Price
                    </label>
                    <div class="input-group">
                        <i class="fas fa-money-bill-wave input-icon"></i>
                        <input type="number" 
                               name="price" 
                               id="price" 
                               class="form-control @error('price') border-red-500 @enderror"
                               value="{{ old('price', $schedule->price) }}"
                               min="1000"
                               step="1000"
                               placeholder="e.g., 35000"
                               required>
                    </div>
                    @error('price')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </div>
                    @enderror
                    <div class="form-help">
                        <i class="fas fa-info-circle mr-1"></i>
                        Minimum price is Rp 1,000 (in Rupiah)
                    </div>
                </div>
            </div>

            <!-- Warning Info -->
            <div class="bg-yellow-900 border border-yellow-700 text-yellow-200 px-6 py-4 rounded-xl mb-6">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-yellow-400 mr-3 mt-1"></i>
                    <div>
                        <h4 class="font-semibold mb-2">Important Notes:</h4>
                        <ul class="text-sm space-y-1 list-disc list-inside">
                            <li>End time will be automatically calculated based on movie duration + 30 minutes buffer</li>
                            <li>The system will check for schedule conflicts in the same studio</li>
                            <li>Existing bookings for this schedule will be preserved</li>
                            <li>Changes might affect customers who have already booked tickets</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>Update Schedule
                </button>
                <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const movieSelect = document.getElementById('movie_id');
    const startTimeInput = document.getElementById('start_time');
    
    // Set minimum date to current date
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    startTimeInput.min = now.toISOString().slice(0, 16);
    
    // Auto-calculate end time when movie or start time changes
    function updateEndTimePreview() {
        const selectedMovie = movieSelect.options[movieSelect.selectedIndex];
        const startTime = startTimeInput.value;
        
        if (selectedMovie.value && startTime) {
            const movieText = selectedMovie.text;
            const durationMatch = movieText.match(/\((\d+) min\)/);
            
            if (durationMatch) {
                const duration = parseInt(durationMatch[1]);
                const startDate = new Date(startTime);
                const endDate = new Date(startDate.getTime() + (duration + 30) * 60000); // +30 min buffer
                
                // Show preview
                const preview = document.getElementById('end-time-preview');
                if (preview) {
                    preview.textContent = `End time: ${endDate.toLocaleString()}`;
                }
            }
        }
    }
    
    movieSelect.addEventListener('change', updateEndTimePreview);
    startTimeInput.addEventListener('change', updateEndTimePreview);
    
    // Initial calculation
    updateEndTimePreview();
});
</script>
@endpush