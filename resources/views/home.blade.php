@extends('layouts.app')

@section('title', 'Home - CinemaTicket')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-900 via-purple-900 to-blue-900 py-20">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">
            Welcome to <span class="text-blue-400">CinemaTicket</span>
        </h1>
        <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
            Book your favorite movies with ease. Discover trending films, check showtimes, and secure your seats in just a few clicks.
        </p>
        <div class="flex justify-center">
            <form action="{{ route('search') }}" method="GET" class="flex w-full max-w-md">
                <input type="text" name="q" placeholder="Search for movies..." 
                       class="flex-1 px-6 py-3 bg-white/10 backdrop-blur-sm text-white placeholder-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-r-lg transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Trending Movies -->
@if($trendingMovies->count() > 0)
<section class="py-16 bg-gray-900">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center mb-8">
            <i class="fas fa-fire text-red-500 text-2xl mr-3"></i>
            <h2 class="text-3xl font-bold">Trending Now</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach($trendingMovies as $movie)
                <x-movie-card :movie="$movie" />
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Now Showing -->
@if($nowShowingMovies->count() > 0)
<section class="py-16 bg-gray-800">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center mb-8">
            <i class="fas fa-play-circle text-green-500 text-2xl mr-3"></i>
            <h2 class="text-3xl font-bold">Now Showing</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach($nowShowingMovies as $movie)
                <x-movie-card :movie="$movie" />
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Top Rated -->
@if($topRatedMovies->count() > 0)
<section class="py-16 bg-gray-900">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center mb-8">
            <i class="fas fa-star text-yellow-500 text-2xl mr-3"></i>
            <h2 class="text-3xl font-bold">Top Rated</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach($topRatedMovies as $movie)
                <x-movie-card :movie="$movie" />
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Features Section -->
<section class="py-16 bg-gray-800">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Why Choose CinemaTicket?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-blue-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Quick Booking</h3>
                <p class="text-gray-400">Book your tickets in just a few clicks without any hassle.</p>
            </div>
            <div class="text-center">
                <div class="bg-green-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-couch text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Choose Your Seats</h3>
                <p class="text-gray-400">Select your preferred seats from our interactive seating chart.</p>
            </div>
            <div class="text-center">
                <div class="bg-purple-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-qrcode text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">QR Code Tickets</h3>
                <p class="text-gray-400">Get your tickets instantly with secure QR codes.</p>
            </div>
        </div>
    </div>
</section>
@endsection