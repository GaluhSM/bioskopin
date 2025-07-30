@extends('layouts.admin')

@section('title', 'Create New Schedule')
@section('page-title', 'Create Schedule')

@push('styles')
<style>
    .create-schedule-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
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
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: block;
        color: #e5e7eb;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 8px;
    }
    
    .form-input, .form-select {
        width: 100%;
        background: #374151;
        border: 1px solid #4b5563;
        border-radius: 12px;
        padding: 12px 16px;
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: #f59e0b;
        background: #4b5563;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }
    
    .form-input::placeholder {
        color: #9ca3af;
    }
    
    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 8px;
        display: flex;
        align-items: center;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
    }
    
    .form-section {
        background: #111827;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
    }
    
    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid #374151;
    }
    
    .section-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
    }
    
    .section-title {
        color: white;
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
    }
    
    .section-description {
        color: #9ca3af;
        font-size: 0.875rem;
        margin: 4px 0 0 0;
    }
    
    .movie-preview {
        background: #374151;
        border-radius: 12px;
        padding: 16px;
        margin-top: 12px;
        display: none;
    }
    
    .movie-preview.show {
        display: flex;
        align-items: center;
        animation: slideDown 0.3s ease;
    }
    
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .movie-poster-mini {
        width: 60px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        margin-right: 16px;
        flex-shrink: 0;
    }
    
    .poster-placeholder-mini {
        background: linear-gradient(135deg, #4b5563 0%, #6b7280 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }
    
    .studio-preview {
        background: #374151;
        border-radius: 12px;
        padding: 16px;
        margin-top: 12px;
        display: none;
    }
    
    .studio-preview.show {
        display: block;
        animation: slideDown 0.3s ease;
    }
    
    .studio-info {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }
    
    .studio-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
    }
    
    .action-buttons {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        justify-content: flex-end;
        padding-top: 24px;
        border-top: 1px solid #374151;
        margin-top: 32px;
    }
    
    .action-btn {
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        font-size: 14px;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }
    
    .btn-secondary {
        background: #374151;
        color: #e5e7eb;
        border: 1px solid #4b5563;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    
    .back-btn {
        background: #374151;
        color: #e5e7eb;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        font-weight: 500;
        transition: all 0.3s ease;
        margin-bottom: 24px;
    }
    
    .back-btn:hover {
        background: #4b5563;
        transform: translateX(-4px);
    }
    
    .datetime-input {
        position: relative;
    }
    
    .datetime-input input[type="datetime-local"] {
        color-scheme: dark;
    }
    
    .price-input {
        position: relative;
    }
    
    .price-prefix {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-weight: 600;
        z-index: 10;
        pointer-events: none;
    }
    
    .price-input input {
        padding-left: 40px;
    }
    
    .conflict-warning {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: #92400e;
        padding: 16px;
        border-radius: 12px;
        margin-top: 16px;
        display: none;
        align-items: center;
    }
    
    .conflict-warning.show {
        display: flex;
        animation: slideDown 0.3s ease;
    }
</style>
@endpush

@section('content')
<div class="create-schedule-container">
    <!-- Back Button -->
    <a href="{{ route('admin.schedules.index') }}" class="back-btn">
        <i class="fas fa-arrow-left mr-2"></i>Back to Schedules
    </a>
    
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white flex items-center">
            <div class="w-12 h-12 bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-plus text-white text-xl"></i>
            </div>
            Create New Schedule
        </h1>
        <p class="text-gray-400 mt-2">Add a new movie schedule to the system</p>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="bg-gradient-to-r from-red-50 to-red-100 border border-red-200 text-red-800 px-6 py-4 rounded-xl mb-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-triangle text-red-500 mr-3 text-lg"></i>
                <span class="font-medium">Please fix the following errors:</span>
            </div>
            <ul class="list-disc list-inside ml-8 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- Main Form -->
    <form action="{{ route('admin.schedules.store') }}" method="POST" id="scheduleForm">
        @csrf
        
        <!-- Movie Selection Section -->
        <div class="form-section">
            <div class="section-header">
                <div class="section-icon bg-gradient-to-br from-blue-500 to-blue-600">
                    <i class="fas fa-film text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="section-title">Movie Selection</h2>
                    <p class="section-description">Select the movie for this schedule</p>
                </div>
            </div>
            
            <div class="form-group">
                <label for="movie_id" class="form-label">Movie</label>
                <select name="movie_id" id="movie_id" class="form-select" required onchange="updateMoviePreview()">
                    <option value="">Select a movie...</option>
                    @foreach($movies as $movie)
                        <option value="{{ $movie->id }}" 
                                data-title="{{ $movie->title }}"
                                data-duration="{{ $movie->duration_minutes }}"
                                data-poster="{{ $movie->poster_url }}"
                                {{ old('movie_id') == $movie->id ? 'selected' : '' }}>
                            {{ $movie->title }} ({{ $movie->duration_minutes }} min)
                        </option>
                    @endforeach
                </select>
                @error('movie_id')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                    </div>
                @enderror
            </div>
            
            <!-- Movie Preview -->
            <div id="moviePreview" class="movie-preview">
                <div class="movie-poster-mini">
                    <div class="poster-placeholder-mini">
                        <i class="fas fa-film text-gray-400"></i>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-1" id="movieTitle">Movie Title</h4>
                    <p class="text-gray-400 text-sm" id="movieDuration">Duration: 0 minutes</p>
                </div>
            </div>
        </div>

        <!-- Studio Selection Section -->
        <div class="form-section">
            <div class="section-header">
                <div class="section-icon bg-gradient-to-br from-purple-500 to-purple-600">
                    <i class="fas fa-door-open text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="section-title">Studio Selection</h2>
                    <p class="section-description">Choose the cinema and studio</p>
                </div>
            </div>
            
            <div class="form-group">
                <label for="studio_id" class="form-label">Studio</label>
                <select name="studio_id" id="studio_id" class="form-select" required onchange="updateStudioPreview()">
                    <option value="">Select a studio...</option>
                    @foreach($studios as $studio)
                        <option value="{{ $studio->id }}" 
                                data-studio-name="{{ $studio->name }}"
                                data-cinema-name="{{ $studio->cinema->name }}"
                                data-cinema-address="{{ $studio->cinema->address }}"
                                {{ old('studio_id') == $studio->id ? 'selected' : '' }}>
                            {{ $studio->cinema->name }} - {{ $studio->name }}
                        </option>
                    @endforeach
                </select>
                @error('studio_id')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                    </div>
                @enderror
            </div>
            
            <!-- Studio Preview -->
            <div id="studioPreview" class="studio-preview">
                <div class="studio-info">
                    <div class="studio-icon">
                        <i class="fas fa-building text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold" id="cinemaName">Cinema Name</h4>
                        <p class="text-gray-400 text-sm" id="studioName">Studio Name</p>
                    </div>
                </div>
                <p class="text-gray-300 text-sm" id="cinemaAddress">Cinema Address</p>
            </div>
        </div>

        <!-- Schedule Details Section -->
        <div class="form-section">
            <div class="section-header">
                <div class="section-icon bg-gradient-to-br from-green-500 to-green-600">
                    <i class="fas fa-calendar-alt text-white text-xl"></i>
                </div>
                <div>
                    <h2 class="section-title">Schedule Details</h2>
                    <p class="section-description">Set the date, time and pricing</p>
                </div>
            </div>
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="start_time" class="form-label">Start Date & Time</label>
                    <div class="datetime-input">
                        <input type="datetime-local" 
                               name="start_time" 
                               id="start_time" 
                               class="form-input" 
                               value="{{ old('start_time') }}"
                               min="{{ now()->format('Y-m-d\TH:i') }}"
                               required
                               onchange="calculateEndTime()">
                    </div>
                    @error('start_time')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="price" class="form-label">Ticket Price (IDR)</label>
                    <div class="price-input">
                        <span class="price-prefix">Rp</span>
                        <input type="number" 
                               name="price" 
                               id="price" 
                               class="form-input" 
                               value="{{ old('price') }}"
                               min="1000"
                               step="1000"
                               placeholder="50000"
                               required>
                    </div>
                    @error('price')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            
            <!-- End Time Display -->
            <div class="form-group">
                <label class="form-label">Estimated End Time</label>
                <div class="form-input bg-gray-600 cursor-not-allowed" id="endTimeDisplay">
                    Select movie and start time to calculate end time
                </div>
            </div>
            
            <!-- Conflict Warning -->
            <div id="conflictWarning" class="conflict-warning">
                <i class="fas fa-exclamation-triangle mr-3 text-lg"></i>
                <div>
                    <strong>Schedule Conflict Detected!</strong>
                    <p class="text-sm mt-1">This time slot conflicts with an existing schedule in the selected studio.</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('admin.schedules.index') }}" class="action-btn btn-secondary">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" class="action-btn btn-primary" id="submitBtn">
                <i class="fas fa-save mr-2"></i>Create Schedule
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function updateMoviePreview() {
    const select = document.getElementById('movie_id');
    const preview = document.getElementById('moviePreview');
    const selectedOption = select.options[select.selectedIndex];
    
    if (selectedOption.value) {
        const title = selectedOption.dataset.title;
        const duration = selectedOption.dataset.duration;
        const poster = selectedOption.dataset.poster;
        
        document.getElementById('movieTitle').textContent = title;
        document.getElementById('movieDuration').textContent = `Duration: ${duration} minutes`;
        
        // Update poster
        const posterContainer = preview.querySelector('.movie-poster-mini');
        if (poster) {
            posterContainer.innerHTML = `<img class="w-full h-full object-cover" src="${poster}" alt="${title}">`;
        } else {
            posterContainer.innerHTML = `
                <div class="poster-placeholder-mini">
                    <i class="fas fa-film text-gray-400"></i>
                </div>
            `;
        }
        
        preview.classList.add('show');
        calculateEndTime();
    } else {
        preview.classList.remove('show');
    }
}

function updateStudioPreview() {
    const select = document.getElementById('studio_id');
    const preview = document.getElementById('studioPreview');
    const selectedOption = select.options[select.selectedIndex];
    
    if (selectedOption.value) {
        const studioName = selectedOption.dataset.studioName;
        const cinemaName = selectedOption.dataset.cinemaName;
        const cinemaAddress = selectedOption.dataset.cinemaAddress;
        
        document.getElementById('studioName').textContent = studioName;
        document.getElementById('cinemaName').textContent = cinemaName;
        document.getElementById('cinemaAddress').textContent = cinemaAddress;
        
        preview.classList.add('show');
    } else {
        preview.classList.remove('show');
    }
}

function calculateEndTime() {
    const movieSelect = document.getElementById('movie_id');
    const startTimeInput = document.getElementById('start_time');
    const endTimeDisplay = document.getElementById('endTimeDisplay');
    
    const selectedMovie = movieSelect.options[movieSelect.selectedIndex];
    const startTime = startTimeInput.value;
    
    if (selectedMovie.value && startTime) {
        const duration = parseInt(selectedMovie.dataset.duration);
        const bufferTime = 30; // 30 minutes buffer
        const totalMinutes = duration + bufferTime;
        
        const startDate = new Date(startTime);
        const endDate = new Date(startDate.getTime() + (totalMinutes * 60000));
        
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            timeZone: 'Asia/Jakarta'
        };
        
        endTimeDisplay.textContent = endDate.toLocaleDateString('en-US', options) + ' WIB';
        endTimeDisplay.classList.remove('bg-gray-600', 'cursor-not-allowed');
        endTimeDisplay.classList.add('bg-green-800', 'text-green-300');
    } else {
        endTimeDisplay.textContent = 'Select movie and start time to calculate end time';
        endTimeDisplay.classList.add('bg-gray-600', 'cursor-not-allowed');
        endTimeDisplay.classList.remove('bg-green-800', 'text-green-300');
    }
}

// Initialize previews if there are old values
document.addEventListener('DOMContentLoaded', function() {
    const movieSelect = document.getElementById('movie_id');
    const studioSelect = document.getElementById('studio_id');
    
    if (movieSelect.value) {
        updateMoviePreview();
    }
    
    if (studioSelect.value) {
        updateStudioPreview();
    }
    
    // Format price input
    const priceInput = document.getElementById('price');
    priceInput.addEventListener('input', function() {
        // Remove non-numeric characters except for the value itself
        let value = this.value.replace(/[^\d]/g, '');
        if (value) {
            // Ensure minimum value
            if (parseInt(value) < 1000) {
                value = '1000';
            }
            this.value = value;
        }
    });
});

// Form validation
document.getElementById('scheduleForm').addEventListener('submit', function(e) {
    const movieId = document.getElementById('movie_id').value;
    const studioId = document.getElementById('studio_id').value;
    const startTime = document.getElementById('start_time').value;
    const price = document.getElementById('price').value;
    
    if (!movieId || !studioId || !startTime || !price) {
        e.preventDefault();
        alert('Please fill in all required fields.');
        return false;
    }
    
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating...';
    submitBtn.disabled = true;
});
</script>
@endpush