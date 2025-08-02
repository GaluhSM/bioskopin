<div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 group">
    <div class="relative">
        @if($movie->poster_url)
            <img src="{{ $movie->poster_url }}" 
                 alt="{{ $movie->title }}" 
                 class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-64 bg-gray-700 flex items-center justify-center">
                <i class="fas fa-film text-4xl text-gray-500"></i>
            </div>
        @endif
        
        @if($movie->is_trending)
            <div class="absolute top-2 left-2 bg-red-600 text-white px-2 py-1 rounded-full text-xs font-semibold flex items-center">
                <i class="fas fa-fire mr-1"></i>Trending
            </div>
        @endif
        
        @if($movie->rating)
            <div class="absolute top-2 right-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded flex items-center">
                <i class="fas fa-star text-yellow-400 mr-1"></i>
                <span class="text-sm font-semibold">{{ $movie->rating }}</span>
            </div>
        @endif
        
        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
    </div>
    
    <div class="p-4">
        <h3 class="text-lg font-semibold text-white mb-2 line-clamp-2">{{ $movie->title }}</h3>
        
        <div class="flex items-center text-gray-400 text-sm mb-2">
            <i class="fas fa-clock mr-2"></i>
            <span>{{ $movie->duration_minutes }} menit</span>
            <span class="mx-2">•</span>
            <span>{{ $movie->audience_rating }}</span>
        </div>
        
        <p class="text-gray-400 text-sm mb-4 line-clamp-3">{{ $movie->synopsis }}</p>
        
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-500">
                {{ \Carbon\Carbon::parse($movie->release_date)->format('M Y') }}
            </div>
            <a href="{{ route('movie.show', $movie->id) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                Lihat Detail
            </a>
        </div>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>