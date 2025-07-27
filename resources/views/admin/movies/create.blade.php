@extends('layouts.admin')

@section('title', 'Add New Movie')

@section('content')
<div class="mb-6">
    <div class="flex items-center mb-4">
        <a href="{{ route('admin.movies.index') }}" 
           class="text-gray-600 hover:text-gray-900 mr-4">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Add New Movie</h1>
            <p class="text-gray-600">Create a new movie entry</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Movie Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Synopsis -->
                <div>
                    <label for="synopsis" class="block text-sm font-medium text-gray-700 mb-2">
                        Synopsis <span class="text-red-500">*</span>
                    </label>
                    <textarea name="synopsis" id="synopsis" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                              required>{{ old('synopsis') }}</textarea>
                    @error('synopsis')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label for="duration_minutes" class="block text-sm font-medium text-gray-700 mb-2">
                        Duration (minutes) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="duration_minutes" id="duration_minutes" 
                           value="{{ old('duration_minutes') }}" min="1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('duration_minutes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Release Date -->
                <div>
                    <label for="release_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Release Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="release_date" id="release_date" 
                           value="{{ old('release_date') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('release_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Audience Rating -->
                <div>
                    <label for="audience_rating" class="block text-sm font-medium text-gray-700 mb-2">
                        Audience Rating <span class="text-red-500">*</span>
                    </label>
                    <select name="audience_rating" id="audience_rating"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
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
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Poster Upload -->
                <div>
                    <label for="poster" class="block text-sm font-medium text-gray-700 mb-2">
                        Movie Poster
                    </label>
                    <input type="file" name="poster" id="poster" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                           onchange="previewImage(this)">
                    <p class="text-sm text-gray-500 mt-1">JPG, PNG, GIF up to 2MB</p>
                    @error('poster')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-4 hidden">
                        <img id="preview" class="h-48 w-32 object-cover rounded-lg shadow-md" alt="Preview">
                    </div>
                </div>

                <!-- Producer -->
                <div>
                    <label for="producer" class="block text-sm font-medium text-gray-700 mb-2">
                        Producer
                    </label>
                    <input type="text" name="producer" id="producer" value="{{ old('producer') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    @error('producer')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Publisher -->
                <div>
                    <label for="publisher" class="block text-sm font-medium text-gray-700 mb-2">
                        Publisher/Distributor
                    </label>
                    <input type="text" name="publisher" id="publisher" value="{{ old('publisher') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    @error('publisher')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rating -->
                <div>
                    <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">
                        Movie Rating (0-10)
                    </label>
                    <input type="number" name="rating" id="rating" 
                           value="{{ old('rating') }}" min="0" max="10" step="0.1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    @error('rating')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Is Trending -->
                <div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_trending" id="is_trending" value="1"
                               {{ old('is_trending') ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_trending" class="ml-2 block text-sm text-gray-700">
                            Mark as trending movie
                        </label>
                    </div>
                    @error('is_trending')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t">
            <a href="{{ route('admin.movies.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
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
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.classList.add('hidden');
    }
}
</script>
@endpush
@endsection