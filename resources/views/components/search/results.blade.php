@if($movies->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-8">
        @foreach($movies as $movie)
            <x-movie-card :movie="$movie" />
        @endforeach
    </div>

    <div class="flex justify-center">
        {{ $movies->appends(['q' => $query])->links() }}
    </div>
@else
    <x-search.no-results :query="$query" />
@endif