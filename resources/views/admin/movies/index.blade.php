@extends('layouts.admin')

@section('title', 'Movies Management')
@section('page-title', 'Movies')

@push('styles')
<style>
    .movie-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(229, 231, 235, 0.5);
        transition: all 0.3s ease;
    }
    
    .movie-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
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
    
    .add-movie-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        font-weight: 600;
    }
    
    .add-movie-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }
    
    .trending-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: bold;
        display: flex;
        align-items: center;
        z-index: 10;
    }
    
    .poster-placeholder {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush

@section('content')
<!-- Header -->
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-600 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-film text-white text-xl"></i>
            </div>
            Movies Management
        </h1>
        <p class="text-gray-600 mt-2">Manage your movie collection and catalog</p>
    </div>
    <a href="{{ route('admin.movies.create') }}" class="add-movie-btn">
        <i class="fas fa-plus mr-2"></i>Add New Movie
    </a>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 text-green-800 px-6 py-4 rounded-xl mb-6 flex items-center">
        <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="bg-gradient-to-r from-red-50 to-red-100 border border-red-200 text-red-800 px-6 py-4 rounded-xl mb-6 flex items-center">
        <i class="fas fa-exclamation-triangle text-red-500 mr-3 text-lg"></i>
        <span class="font-medium">{{ session('error') }}</span>
    </div>
@endif

<!-- Movies Grid -->
@if($movies->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($movies as $movie)
        <div class="movie-card">
            <!-- Movie Poster -->
            <div class="relative h-64 overflow-hidden">
                @if($movie->is_trending)
                    <div class="trending-badge">
                        <i class="fas fa-fire mr-1"></i>
                        Trending
                    </div>
                @endif
                
                @if($movie->poster_url)
                    <img class="w-full h-full object-cover" 
                         src="{{ asset('storage/' . $movie->poster_url) }}" 
                         alt="{{ $movie->title }}">
                @else
                    <div class="poster-placeholder w-full h-full">
                        <i class="fas fa-film text-white text-4xl"></i>
                    </div>
                @endif
                
                <!-- Overlay with rating -->
                @if($movie->rating)
                    <div class="absolute bottom-3 left-3 bg-black/70 backdrop-blur-sm px-3 py-1 rounded-full">
                        <div class="flex items-center text-white text-sm">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <span class="font-semibold">{{ $movie->rating }}/10</span>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Movie Info -->
            <div class="p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $movie->title }}</h3>
                    <div class="flex items-center justify-between text-sm text-gray-600 mb-3">
                        <span class="bg-gray-100 px-2 py-1 rounded-full text-xs font-medium">{{ $movie->audience_rating }}</span>
                        <span class="flex items-center">
                            <i class="fas fa-clock mr-1"></i>
                            {{ $movie->duration_minutes }} min
                        </span>
                    </div>
                    <p class="text-gray-600 text-sm line-clamp-3 mb-3">{{ $movie->synopsis }}</p>
                    <div class="text-xs text-gray-500">
                        <div class="flex items-center justify-between">
                            <span>{{ $movie->release_date->format('M j, Y') }}</span>
                            <span>{{ $movie->producer ?? 'Unknown Producer' }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center justify-center space-x-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.movies.show', $movie) }}" 
                       class="action-btn bg-blue-100 text-blue-600 hover:bg-blue-200" 
                       title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.movies.edit', $movie) }}" 
                       class="action-btn bg-indigo-100 text-indigo-600 hover:bg-indigo-200" 
                       title="Edit Movie">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.movies.destroy', $movie) }}" 
                          method="POST" class="inline" 
                          onsubmit="return confirm('Are you sure you want to delete this movie?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="action-btn bg-red-100 text-red-600 hover:bg-red-200" 
                                title="Delete Movie">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    @if($movies->hasPages())
        <div class="mt-8 flex justify-center">
            <div class="bg-white rounded-xl p-4 shadow-lg">
                {{ $movies->links() }}
            </div>
        </div>
    @endif
@else
    <!-- Empty State -->
    <div class="text-center py-16">
        <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-film text-gray-400 text-5xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4">No Movies Found</h3>
        <p class="text-gray-600 mb-8 max-w-md mx-auto">
            Get started by adding your first movie to the catalog. You can manage all your movies from here.
        </p>
        <a href="{{ route('admin.movies.create') }}" class="add-movie-btn inline-flex">
            <i class="fas fa-plus mr-2"></i>Add Your First Movie
        </a>
    </div>
@endif
@endsection