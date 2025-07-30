@extends('layouts.admin')

@section('title', $movie->title . ' - Movie Details')
@section('page-title', 'Movie Details')

@push('styles')
<style>
    .movie-detail-container {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .movie-hero {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        padding: 3rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .movie-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.05"/><circle cx="10" cy="50" r="0.5" fill="white" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        pointer-events: none;
    }
    
    .movie-poster {
        width: 300px;
        height: 420px;
        margin: 0 auto 2rem;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 10;
    }
    
    .movie-poster img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .poster-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #374151 0%, #4b5563 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: #9ca3af;
    }
    
    .movie-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 1rem;
        position: relative;
        z-index: 10;
    }
    
    .movie-meta {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 2rem;
        margin-bottom: 2rem;
        position: relative;
        z-index: 10;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
    }
    
    .meta-item i {
        margin-right: 0.5rem;
        font-size: 1.1rem;
    }
    
    .trending-badge {
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: bold;
        display: inline-flex;
        align-items: center;
        margin-bottom: 1rem;
        position: relative;
        z-index: 10;
    }
    
    .rating-display {
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
        padding: 1rem 2rem;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        margin-bottom: 2rem;
        position: relative;
        z-index: 10;
    }
    
    .rating-stars {
        color: #fbbf24;
        font-size: 1.2rem;
        margin-right: 1rem;
    }
    
    .rating-score {
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
    }
    
    .movie-content {
        padding: 3rem;
    }
    
    .content-section {
        margin-bottom: 3rem;
    }
    
    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #e5e7eb;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }
    
    .section-title i {
        margin-right: 0.75rem;
        color: #3b82f6;
    }
    
    .synopsis-text {
        color: #d1d5db;
        line-height: 1.8;
        font-size: 1.1rem;
        text-align: justify;
    }
    
    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }
    
    .detail-card {
        background: #374151;
        border: 1px solid #4b5563;
        border-radius: 16px;
        padding: 2rem;
        transition: all 0.3s ease;
    }
    
    .detail-card:hover {
        background: #4b5563;
        border-color: #6b7280;
        transform: translateY(-2px);
    }
    
    .detail-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }
    
    .detail-value {
        font-size: 1.125rem;
        font-weight: 600;
        color: #e5e7eb;
    }
    
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 3rem;
        padding-top: 3rem;
        border-top: 1px solid #4b5563;
    }
    
    .btn {
        padding: 1rem 2rem;
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
        min-width: 140px;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    
    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
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
    
    .audience-rating-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: #4b5563;
        color: #e5e7eb;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
    }
    
    @media (max-width: 768px) {
        .movie-hero {
            padding: 2rem 1rem;
        }
        
        .movie-poster {
            width: 250px;
            height: 350px;
        }
        
        .movie-title {
            font-size: 2rem;
        }
        
        .movie-meta {
            flex-direction: column;
            gap: 1rem;
        }
        
        .movie-content {
            padding: 2rem;
        }
        
        .details-grid {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
            align-items: center;
        }
    }
</style>
@endpush

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex items-center mb-8">
        <a href="{{ route('admin.movies.index') }}" class="mr-4 p-2 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors">
            <i class="fas fa-arrow-left text-white"></i>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-white flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-eye text-white text-xl"></i>
                </div>
                Movie Details
            </h1>
            <p class="text-gray-400 mt-2">Complete information about this movie</p>
        </div>
    </div>

    <!-- Movie Detail Container -->
    <div class="movie-detail-container">
        <!-- Hero Section -->
        <div class="movie-hero">
            @if($movie->is_trending)
                <div class="trending-badge">
                    <i class="fas fa-fire mr-2"></i>
                    Trending Now
                </div>
            @endif
            
            <!-- Movie Poster -->
            <div class="movie-poster">
                @if($movie->poster_url)
                    <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}">
                @else
                    <div class="poster-placeholder">
                        <i class="fas fa-film text-6xl mb-4"></i>
                        <span class="text-lg">No Poster Available</span>
                    </div>
                @endif
            </div>
            
            <!-- Movie Title -->
            <h1 class="movie-title">{{ $movie->title }}</h1>
            
            <!-- Rating Display -->
            @if($movie->rating)
                <div class="rating-display">
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($movie->rating / 2))
                                <i class="fas fa-star"></i>
                            @elseif($i == ceil($movie->rating / 2) && $movie->rating % 2 != 0)
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="rating-score">{{ $movie->rating }}/10</span>
                </div>
            @endif
            
            <!-- Movie Meta -->
            <div class="movie-meta">
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span>{{ $movie->duration_minutes }} minutes</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ \Carbon\Carbon::parse($movie->release_date)->format('F j, Y') }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-users"></i>
                    <span class="audience-rating-badge">{{ $movie->audience_rating }}</span>
                </div>
            </div>
        </div>
        
        <!-- Content Section -->
        <div class="movie-content">
            <!-- Synopsis -->
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-align-left"></i>
                    Synopsis
                </h2>
                <p class="synopsis-text">{{ $movie->synopsis }}</p>
            </div>
            
            <!-- Movie Details -->
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Movie Information
                </h2>
                <div class="details-grid">
                    <div class="detail-card">
                        <div class="detail-label">Producer</div>
                        <div class="detail-value">{{ $movie->producer ?: 'Not specified' }}</div>
                    </div>
                    
                    <div class="detail-card">
                        <div class="detail-label">Publisher</div>
                        <div class="detail-value">{{ $movie->publisher ?: 'Not specified' }}</div>
                    </div>
                    
                    <div class="detail-card">
                        <div class="detail-label">Duration</div>
                        <div class="detail-value">{{ $movie->duration_minutes }} minutes</div>
                    </div>
                    
                    <div class="detail-card">
                        <div class="detail-label">Release Date</div>
                        <div class="detail-value">{{ \Carbon\Carbon::parse($movie->release_date)->format('F j, Y') }}</div>
                    </div>
                    
                    <div class="detail-card">
                        <div class="detail-label">Audience Rating</div>
                        <div class="detail-value">
                            <span class="audience-rating-badge">{{ $movie->audience_rating }}</span>
                        </div>
                    </div>
                    
                    <div class="detail-card">
                        <div class="detail-label">Movie Rating</div>
                        <div class="detail-value">
                            @if($movie->rating)
                                <div class="flex items-center">
                                    <span class="text-yellow-400 mr-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= floor($movie->rating / 2))
                                                <i class="fas fa-star"></i>
                                            @elseif($i == ceil($movie->rating / 2) && $movie->rating % 2 != 0)
                                                <i class="fas fa-star-half-alt"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </span>
                                    <span>{{ $movie->rating }}/10</span>
                                </div>
                            @else
                                <span class="text-gray-400">Not rated</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list mr-2"></i>Back to List
                </a>
                
                <a href="{{ route('admin.movies.edit', $movie) }}" class="btn btn-warning">
                    <i class="fas fa-edit mr-2"></i>Edit Movie
                </a>
                
                <form action="{{ route('admin.movies.destroy', $movie) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this movie? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash mr-2"></i>Delete Movie
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection