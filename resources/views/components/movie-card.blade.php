@props(['movie'])

<div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 group">
    <div class="relative">
        <img src="{{ $movie->poster_url ?? 'https://via.placeholder.com/300x450/374151/9CA3AF?text=No+Image' }}" 
             alt="{{ $movie->title }}" 
             class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
        
        @if($movie->is_trending)
        <div class="absolute top-2 left-2 bg-red-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
            <i class="fas fa-fire mr-1"></i>Trending
        </div>
        @endif

        @if($movie->rating)
        <div class="absolute top-2 right-2 bg-yellow-500 text-black px-2 py-1 rounded-full text-xs font-bold">
            <i class="fas fa-star mr-1"></i>{{ $movie->rating }}
        </div>
        @endif
    </div>
    
    <div class="p-4">
        <h3 class="text-lg font-semibold mb-2 text-white group-hover:text-blue-400 transition-colors">
            {{ $movie->title }}
        </h3>
        
        <div class="flex items-center text-sm text-gray-400 mb-2">
            <i class="fas fa-clock mr-1"></i>
            <span>{{ $movie->duration_minutes }} min</span>
            <span class="mx-2">•</span>
            <span>{{ $movie->audience_rating }}</span>
        </div>
        
        <p class="text-gray-300 text-sm mb-4 line-clamp-3">
            {{ Str::limit($movie->synopsis, 100) }}
        </p>
        
        <a href="{{ route('movie.show', $movie->id) }}" 
           class="inline-block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg transition-colors duration-200">
            <i class="fas fa-ticket-alt mr-2"></i>View Details
        </a>
    </div>
</div>