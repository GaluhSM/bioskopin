<div class="flex items-center mb-4">
    @if($movie->is_trending)
    <span class="bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold mr-3">
        <i class="fas fa-fire mr-1"></i>Trending
    </span>
    @endif
    @if($movie->rating)
    <span class="bg-yellow-500 text-black px-3 py-1 rounded-full text-sm font-bold">
        <i class="fas fa-star mr-1"></i>{{ $movie->rating }}
    </span>
    @endif
</div>