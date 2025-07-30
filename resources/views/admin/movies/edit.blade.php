
@extends('layouts.admin')

@section('title', 'Edit Movie - ' . $movie->title)
@section('page-title', 'Edit Movie')

@push('styles')
<style>
    .form-container {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .form-header {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        padding: 2rem;
        text-align: center;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        color: #e5e7eb;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .form-input {
        width: 100%;
        padding: 0.875rem 1rem;
        background: #374151;
        border: 1px solid #4b5563;
        border-radius: 12px;
        color: #ffffff;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #f59e0b;
        background: #4b5563;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }
    
    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }
    
    .file-input-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    
    .file-input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }
    
    .file-input-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: #374151;
        border: 2px dashed #4b5563;
        border-radius: 12px;
        color: #9ca3af;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }
    
    .file-input-label:hover {
        border-color: #f59e0b;
        background: #4b5563;
        color: #e5e7eb;
    }
    
    .checkbox-wrapper {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: #374151;
        border: 1px solid #4b5563;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .checkbox-wrapper:hover {
        background: #4b5563;
        border-color: #f59e0b;
    }
    
    .checkbox-input {
        width: 1.25rem;
        height: 1.25rem;
        margin-right: 0.75rem;
        accent-color: #f59e0b;
    }
    
    .btn {
        padding: 0.875rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
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
        color: #e5e7eb;
        border: 1px solid #4b5563;
    }
    
    .btn-secondary:hover {
        background: #4b5563;
        border-color: #6b7280;
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
    }
    
    .error-message {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
    }
    
    .error-message i {
        margin-right: 0.25rem;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .current-poster {
        position: relative;
        width: 200px;
        height: 280px;
        margin: 0 auto;
        border-radius: 12px;
        overflow: hidden;
        background: #374151;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }
    
    .current-poster img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .poster-placeholder {
        color: #9ca3af;
        text-align: center;
    }
    
    .preview-container {
        position: relative;
        width: 200px;
        height: 280px;
        margin: 0 auto;
        border-radius: 12px;
        overflow: hidden;
        background: #374151;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 1rem;
    }
    
    .preview-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .delete-btn {
        background: none;
        border: none;
        color: #ef4444;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    
    .delete-btn:hover {
        background: rgba(239, 68, 68, 0.1);
    }
</style>
@endpush

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="flex items-center mb-8">
        <a href="{{ route('admin.movies.index') }}" class="mr-4 p-2 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors">
            <i class="fas fa-arrow-left text-white"></i>
        </a>
        <div class="flex-1">
            <h1 class="text-3xl font-bold text-white flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-edit text-white text-xl"></i>
                </div>
                Edit Movie
            </h1>
            <p class="text-gray-400 mt-2">Update information for: <span class="text-white font-medium">{{ $movie->title }}</span></p>
        </div>
        
        <!-- Delete Button -->
        <form action="{{ route('admin.movies.destroy', $movie) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this movie? This action cannot be undone.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash mr-2"></i>Delete Movie
            </button>
        </form>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <div class="form-header">
            <i class="fas fa-film text-white text-4xl mb-4"></i>
            <h2 class="text-2xl font-bold text-white mb-2">Edit Movie Information</h2>
            <p class="text-amber-100 opacity-90">Update the movie details below</p>
        </div>
        
        <form action="{{ route('admin.movies.update', $movie) }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Poster Upload -->
                <div class="lg:col-span-1">
                    <div class="form-group">
                        <label for="synopsis" class="form-label">Synopsis *</label>
                        <textarea name="synopsis" id="synopsis" class="form-input form-textarea" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
                        @error('synopsis')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <!-- Movie Details Grid -->
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="duration_minutes" class="form-label">Duration (minutes) *</label>
                            <input type="number" name="duration_minutes" id="duration_minutes" class="form-input" value="{{ old('duration_minutes', $movie->duration_minutes) }}" min="1" required>
                            @error('duration_minutes')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="release_date" class="form-label">Release Date *</label>
                            <input type="date" name="release_date" id="release_date" class="form-input" value="{{ old('release_date', $movie->release_date) }}" required>
                            @error('release_date')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="audience_rating" class="form-label">Audience Rating *</label>
                            <select name="audience_rating" id="audience_rating" class="form-input form-select" required>
                                <option value="">Select Rating</option>
                                <option value="G" {{ old('audience_rating', $movie->audience_rating) == 'G' ? 'selected' : '' }}>G - General Audiences</option>
                                <option value="PG" {{ old('audience_rating', $movie->audience_rating) == 'PG' ? 'selected' : '' }}>PG - Parental Guidance</option>
                                <option value="PG-13" {{ old('audience_rating', $movie->audience_rating) == 'PG-13' ? 'selected' : '' }}>PG-13 - Parents Strongly Cautioned</option>
                                <option value="R" {{ old('audience_rating', $movie->audience_rating) == 'R' ? 'selected' : '' }}>R - Restricted</option>
                                <option value="NC-17" {{ old('audience_rating', $movie->audience_rating) == 'NC-17' ? 'selected' : '' }}>NC-17 - Adults Only</option>
                                <option value="SU" {{ old('audience_rating', $movie->audience_rating) == 'SU' ? 'selected' : '' }}>SU - Semua Umur</option>
                                <option value="13+" {{ old('audience_rating', $movie->audience_rating) == '13+' ? 'selected' : '' }}>13+ - 13 Tahun ke Atas</option>
                                <option value="17+" {{ old('audience_rating', $movie->audience_rating) == '17+' ? 'selected' : '' }}>17+ - 17 Tahun ke Atas</option>
                                <option value="21+" {{ old('audience_rating', $movie->audience_rating) == '21+' ? 'selected' : '' }}>21+ - Dewasa</option>
                            </select>
                            @error('audience_rating')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="rating" class="form-label">Movie Rating (1-10)</label>
                            <input type="number" name="rating" id="rating" class="form-input" value="{{ old('rating', $movie->rating) }}" min="0" max="10" step="0.1">
                            @error('rating')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="producer" class="form-label">Producer</label>
                            <input type="text" name="producer" id="producer" class="form-input" value="{{ old('producer', $movie->producer) }}">
                            @error('producer')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="publisher" class="form-label">Publisher</label>
                            <input type="text" name="publisher" id="publisher" class="form-input" value="{{ old('publisher', $movie->publisher) }}">
                            @error('publisher')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Trending Checkbox -->
                    <div class="form-group">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" name="is_trending" id="is_trending" class="checkbox-input" value="1" {{ old('is_trending', $movie->is_trending) ? 'checked' : '' }}>
                            <div>
                                <div class="text-white font-medium flex items-center">
                                    <i class="fas fa-fire text-red-500 mr-2"></i>
                                    Mark as Trending Movie
                                </div>
                                <div class="text-gray-400 text-sm mt-1">This movie will be highlighted as trending</div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-600">
                <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>Update Movie
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const currentPoster = document.getElementById('currentPoster');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
            if (currentPoster) {
                currentPoster.parentElement.style.display = 'none';
            }
        }
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        if (currentPoster) {
            currentPoster.parentElement.style.display = 'block';
        }
    }
}

function removePoster() {
    if (confirm('Are you sure you want to remove the current poster?')) {
        const currentPoster = document.getElementById('currentPoster');
        if (currentPoster) {
            currentPoster.parentElement.style.display = 'none';
        }
        
        // Add hidden input to indicate poster removal
        const form = document.querySelector('form');
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'remove_poster';
        hiddenInput.value = '1';
        form.appendChild(hiddenInput);
    }
}
</script>
@endsection