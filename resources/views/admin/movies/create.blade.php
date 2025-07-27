@extends('layouts.admin')

@section('title', 'Add New Movie')
@section('page-title', 'Add Movie')

@push('styles')
<style>
    .form-container {
        background: white;
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(229, 231, 235, 0.5);
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        transition: all 0.2s ease;
        font-size: 14px;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .required {
        color: #ef4444;
    }
    
    .info-box {
        background: linear-gradient(135deg, #dbeafe 0%, #e0e7ff 100%);
        border: 1px solid #bfdbfe;
        border-radius: 16px;
        padding: 20px;
        margin-top: 24px;
    }
    
    .preview-container {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        transition: all 0.2s ease;
        background: #f9fafb;
    }
    
    .preview-container:hover {
        border-color: #3b82f6;
        background: #f0f9ff;
    }
    
    .image-preview {
        max-width: 200px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .submit-btn {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }
    
    .cancel-btn {
        background: #f3f4f6;
        color: #374151;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-block;
    }
    
    .cancel-btn:hover {
        background: #e5e7eb;
        transform: translateY(-1px);
    }
</style>
@endpush

@section('content')
<!-- Header -->
<div class="mb-8">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.movies.index') }}" 
           class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center justify-center mr-4 transition-colors">
            <i class="fas fa-arrow-left text-gray-600"></i>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-plus text-white text-xl"></i>
                </div>
                Add New Movie
            </h1>
            <p class="text-gray-600 mt-2">Create a new movie entry for your catalog</p>
        </div>
    </div>
</div>

<div class="form-container">
    <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-6">
                <div class="form-group">
                    <label for="title" class="form-label">
                        Movie Title <span class="required">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                           class="form-input @error('title') border-red-300 @enderror"
                           placeholder="Enter movie title"
                           required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="synopsis" class="form-label">
                        Synopsis <span class="required">*</span>
                    </label>
                    <textarea name="synopsis" id="synopsis" rows="5"
                              class="form-input form-textarea @error('synopsis') border-red-300 @enderror"
                              placeholder="Write a compelling movie synopsis..."
                              required>{{ old('synopsis') }}</textarea>
                    @error('synopsis')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label for="duration_minutes" class="form-label">
                            Duration (minutes) <span class="required">*</span>
                        </label>
                        <input type="number" name="duration_minutes" id="duration_minutes" 
                               value="{{ old('duration_minutes') }}" min="1"
                               class="form-input @error('duration_minutes') border-red-300 @enderror"
                               placeholder="120"
                               required>
                        @error('duration_minutes')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="rating" class="form-label">
                            Movie Rating (0-10)
                        </label>
                        <input type="number" name="rating" id="rating" 
                               value="{{ old('rating') }}" min="0" max="10" step="0.1"
                               class="form-input @error('rating') border-red-300 @enderror"
                               placeholder="8.5">
                        @error('rating')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="release_date" class="form-label">
                        Release Date <span class="required">*</span>
                    </label>
                    <input type="date" name="release_date" id="release_date" 
                           value="{{ old('release_date') }}"
                           class="form-input @error('release_date') border-red-300 @enderror"
                           required>
                    @error('release_date')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="audience_rating" class="form-label">
                        Audience Rating <span class="required">*</span>
                    </label>
                    <select name="audience_rating" id="audience_rating"
                            class="form-input @error('audience_rating') border-red-300 @enderror"
                            required>
                        <option value="">Select Rating</option>
                        <option value="G" {{ old('audience_rating') == 'G' ? 'selected' : '' }}>G - General Audiences</option>
                        <option value="PG" {{ old('audience_rating') == 'PG' ? 'selected' : '' }}>PG - Parental Guidance</option>
                        <option value="PG-13" {{ old('audience_rating') == 'PG-13' ? 'selected' : '' }}>PG-13 - Parents Strongly Cautioned</option>
                        <option value="R" {{ old('audience_rating') == 'R' ? 'selected' : '' }}>R - Restricted</option>
                        <option value="SU" {{ old('audience_rating') == 'SU' ? 'selected' : '' }}>SU - Semua Umur</option>
                        <option value="13+" {{ old('audience_rating') == '13+' ? 'selected' : '' }}>13+ - 13 Tahun ke Atas</option>
                        <option value="17+" {{ old('audience_rating') == '17+' ? 'selected' : '' }}>17+ - 17 Tahun ke Atas</option>
                        <option value="21+" {{ old('audience_rating') == '21+' ? 'selected' : '' }}>21+ - Dewasa</option>
                    </select>
                    @error('audience_rating')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <div class="form-group">
                    <label for="poster" class="form-label">
                        Movie Poster
                    </label>
                    <div class="preview-container">
                        <input type="file" name="poster" id="poster" accept="image/*"
                               class="hidden @error('poster') border-red-300 @enderror"
                               onchange="previewImage(this)">
                        <label for="poster" class="cursor-pointer">
                            <div id="upload-placeholder">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-600 font-medium mb-2">Click to upload poster</p>
                                <p class="text-gray-500 text-sm">JPG, PNG, GIF up to 2MB</p>
                            </div>
                        </label>
                        
                        <div id="imagePreview" class="hidden">
                            <img id="preview" class="image-preview mx-auto" alt="Preview">
                            <button type="button" onclick="removeImage()" class="mt-4 text-red-600 hover:text-red-800 text-sm">
                                <i class="fas fa-trash mr-1"></i>Remove Image
                            </button>
                        </div>
                    </div>
                    @error('poster')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="producer" class="form-label">
                        Producer
                    </label>
                    <input type="text" name="producer" id="producer" value="{{ old('producer') }}"
                           class="form-input @error('producer') border-red-300 @enderror"
                           placeholder="Producer name">
                    @error('producer')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="publisher" class="form-label">
                        Publisher/Distributor
                    </label>
                    <input type="text" name="publisher" id="publisher" value="{{ old('publisher') }}"
                           class="form-input @error('publisher') border-red-300 @enderror"
                           placeholder="Distribution company">
                    @error('publisher')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_trending" id="is_trending" value="1"
                               {{ old('is_trending') ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                        <label for="is_trending" class="ml-3 text-sm font-medium text-gray-700">
                            Mark as trending movie
                        </label>
                    </div>
                    <p class="text-gray-500 text-sm mt-2">Trending movies will be highlighted in the catalog</p>
                    @error('is_trending')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div class="info-box">
            <h3 class="text-sm font-semibold text-blue-800 mb-3 flex items-center">
                <i class="fas fa-info-circle mr-2"></i>Movie Information Tips
            </h3>
            <ul class="text-sm text-blue-700 space-y-2">
                <li class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-600"></i>
                    Use a high-quality poster image for better visual appeal
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-600"></i>
                    Write a compelling synopsis that captures the essence of the movie
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-600"></i>
                    Double-check the rating and duration for accuracy
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-600"></i>
                    Mark trending movies to highlight them to customers
                </li>
            </ul>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.movies.index') }}" class="cancel-btn">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" class="submit-btn">
                <i class="fas fa-save mr-2"></i>Create Movie
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    const placeholder = document.getElementById('upload-placeholder');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        removeImage();
    }
}

function removeImage() {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    const placeholder = document.getElementById('upload-placeholder');
    const input = document.getElementById('poster');
    
    preview.src = '';
    input.value = '';
    previewContainer.classList.add('hidden');
    placeholder.classList.remove('hidden');
}
</script>
@endpush
@endsection