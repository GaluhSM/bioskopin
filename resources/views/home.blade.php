<x-app-layout title="Beranda - Bioskopin">
    <x-hero-section />

    <x-movie-section 
        :movies="$trendingMovies"
        title="Sedang Trending"
        icon="fas fa-fire"
        iconColor="red"
        bgColor="gray-900" />

    <x-movie-section 
        :movies="$nowShowingMovies"
        title="Sedang Tayang"
        icon="fas fa-play-circle"
        iconColor="green"
        bgColor="gray-800" />

    <x-movie-section 
        :movies="$topRatedMovies"
        title="Rating Tertinggi"
        icon="fas fa-star"
        iconColor="yellow"
        bgColor="gray-900" />

    <x-features-section />
</x-app-layout>