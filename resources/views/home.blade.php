@extends('layouts.app')

@section('title', 'Beranda - Cari Film Favoritmu')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="text-center py-16">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">Temukan Film Favoritmu</h1>
        <p class="text-lg text-gray-300 mb-8 max-w-2xl mx-auto">Jelajahi film-film terbaru, trending, dan terbaik yang sedang tayang di bioskop kami.</p>
        <form action="{{-- route('search.movies') --}}" method="GET" class="max-w-xl mx-auto">
            <div class="relative">
                <input 
                    type="search" 
                    name="query"
                    placeholder="Contoh: Dune: Part Two..." 
                    class="w-full bg-gray-800 border-2 border-gray-700 rounded-full py-3 px-6 text-white placeholder-gray-500 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition duration-300"
                >
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-cyan-500 hover:bg-cyan-600 rounded-full p-2 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <!-- Movie Sections -->
    @php
        // DUMMY DATA: Ganti ini dengan data dari controller Anda
        // $trendingMovies, $nowPlayingMovies, $topRatedMovies
        // Contoh: $trendingMovies = App\Models\Movie::where('is_trending', true)->take(5)->get();
    @endphp

    <!-- Trending Movies -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold border-l-4 border-cyan-400 pl-4 mb-6">Lagi Trending 🔥</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @forelse ($trendingMovies as $movie)
                <x-movie-card :movie="$movie" />
            @empty
                <p class="text-gray-400 col-span-full">Belum ada film trending saat ini.</p>
            @endforelse
        </div>
    </section>

    <!-- Now Playing Movies -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold border-l-4 border-cyan-400 pl-4 mb-6">Sedang Tayang</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @forelse ($nowPlayingMovies as $movie)
                <x-movie-card :movie="$movie" />
            @empty
                <p class="text-gray-400 col-span-full">Belum ada film yang sedang tayang.</p>
            @endforelse
        </div>
    </section>

    <!-- Top Rated Movies -->
    <section>
        <h2 class="text-2xl font-bold border-l-4 border-cyan-400 pl-4 mb-6">Rating Tertinggi ⭐</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @forelse ($topRatedMovies as $movie)
                <x-movie-card :movie="$movie" />
            @empty
                <p class="text-gray-400 col-span-full">Data rating film belum tersedia.</p>
            @endforelse
        </div>
    </section>

</div>
@endsection

{{-- BUAT FILE INI: resources/views/components/movie-card.blade.php --}}
{{-- 
@props(['movie'])
<a href="{{ route('movies.show', $movie) }}" class="group block bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-cyan-500/20 transition-all duration-300 transform hover:-translate-y-2">
    <div class="relative">
        <img src="{{ $movie->poster_url ?: 'https://placehold.co/300x450/111827/FFFFFF?text=' . urlencode($movie->title) }}" alt="Poster {{ $movie->title }}" class="w-full h-auto object-cover aspect-[2/3]">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        @if($movie->rating)
        <div class="absolute top-2 right-2 bg-amber-500 text-white text-xs font-bold px-2 py-1 rounded-full flex items-center space-x-1">
            <span>⭐</span>
            <span>{{ number_format($movie->rating, 1) }}</span>
        </div>
        @endif
    </div>
    <div class="p-4">
        <h3 class="font-bold text-md truncate text-white">{{ $movie->title }}</h3>
        <p class="text-sm text-gray-400">{{ $movie->audience_rating }}</p>
    </div>
</a>
--}}
