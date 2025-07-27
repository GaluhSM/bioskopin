@extends('layouts.app')

@section('title', 'Search Results - CinemaTicket')

@section('content')
<div class="py-8 bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Search Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-4">
                @if($query)
                    Search Results for "<span class="text-blue-400">{{ $query }}</span>"
                @else
                    All Movies
                @endif
            </h1>
            <p class="text-gray-400">{{ $movies->total() }} movie(s) found</p>
        </div>

        <!-- Search Form -->
        <div class="mb-8">
            <form action="{{ route('search') }}" method="GET" class="flex max-w-md">
                <input type="text" name="q" placeholder="Search movies..." 
                       value="{{ $query }}"
                       class="flex-1 px-4 py-3 bg-gray-800 text-white border border-gray-700 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-r-lg transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        @if($movies->count() > 0)
            <!-- Movies Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-8">
                @foreach($movies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $movies->appends(['q' => $query])->links() }}
            </div>
        @else
            <!-- No Results -->
            <div class="text-center py-16">
                <i class="fas fa-search text-6xl text-gray-600 mb-4"></i>
                <h2 class="text-2xl font-semibold mb-2">No movies found</h2>
                <p class="text-gray-400 mb-6">
                    @if($query)
                        We couldn't find any movies matching "{{ $query }}". Try searching with different keywords.
                    @else
                        No movies available at the moment.
                    @endif
                </p>
                <a href="{{ route('home') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors">
                    <i class="fas fa-home mr-2"></i>Back to Home
                </a>
            </div>
        @endif
    </div>
</div>
@endsection