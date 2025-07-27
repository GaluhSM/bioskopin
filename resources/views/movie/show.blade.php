@extends('layouts.app')

@section('title', $movie->title . ' - CinemaTicket')

@section('content')
<div class="bg-gray-900 min-h-screen">
    <!-- Movie Hero -->
    <div class="relative bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent">
        <div class="absolute inset-0 bg-cover bg-center opacity-20" 
             style="background-image: url('{{ $movie->poster_url ?? 'https://via.placeholder.com/1920x1080/374151/9CA3AF' }}');"></div>
        <div class="relative max-w-7xl mx-auto px-4 py-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Poster -->
                <div class="lg:col-span-1">
                    <img src="{{ $movie->poster_url ?? 'https://via.placeholder.com/400x600/374151/9CA3AF?text=No+Image' }}" 
                         alt="{{ $movie->title }}" 
                         class="w-full max-w-sm mx-auto rounded-lg shadow-2xl">
                </div>
                
                <!-- Movie Info -->
                <div class="lg:col-span-2">
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
                    
                    <h1 class="text-4xl lg:text-5xl font-bold mb-4">{{ $movie->title }}</h1>
                    
                    <div class="flex flex-wrap items-center text-gray-300 mb-6 space-x-6">
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <span>{{ $movie->duration_minutes }} minutes</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>{{ $movie->release_date->format('Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-users mr-2"></i>
                            <span>{{ $movie->audience_rating }}</span>
                        </div>
                    </div>
                    
                    @if($movie->producer || $movie->publisher)
                    <div class="mb-6">
                        @if($movie->producer)
                        <p class="text-gray-300 mb-2">
                            <span class="font-semibold">Producer:</span> {{ $movie->producer }}
                        </p>
                        @endif
                        @if($movie->publisher)
                        <p class="text-gray-300">
                            <span class="font-semibold">Publisher:</span> {{ $movie->publisher }}
                        </p>
                        @endif
                    </div>
                    @endif
                    
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-3">Synopsis</h3>
                        <p class="text-gray-300 leading-relaxed">{{ $movie->synopsis }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Showtimes -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold mb-8">
            <i class="fas fa-calendar-alt mr-3 text-blue-400"></i>Showtimes & Tickets
        </h2>
        
        @if($schedules->count() > 0)
            <div class="grid gap-6">
                @php
                    $groupedSchedules = $schedules->groupBy(function($schedule) {
                        return $schedule->start_time->format('Y-m-d');
                    });
                @endphp
                
                @foreach($groupedSchedules as $date => $dateSchedules)
                    <div class="bg-gray-800 rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-4 text-blue-400">
                            {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}
                        </h3>
                        
                        @php
                            $cinemaSchedules = $dateSchedules->groupBy('studio.cinema.name');
                        @endphp
                        
                        @foreach($cinemaSchedules as $cinemaName => $cinemaScheduleList)
                            <div class="mb-6 last:mb-0">
                                <h4 class="text-lg font-semibold mb-3 text-gray-300">
                                    <i class="fas fa-map-marker-alt mr-2"></i>{{ $cinemaName }}
                                    <span class="text-sm text-gray-400 ml-2">
                                        ({{ $cinemaScheduleList->first()->studio->cinema->location }})
                                    </span>
                                </h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($cinemaScheduleList as $schedule)
                                        <div class="bg-gray-700 rounded-lg p-4 hover:bg-gray-600 transition-colors">
                                            <div class="flex justify-between items-start mb-3">
                                                <div>
                                                    <p class="font-semibold text-white">{{ $schedule->studio->name }}</p>
                                                    <p class="text-sm text-gray-300">
                                                        {{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }}
                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-lg font-bold text-green-400">
                                                        Rp {{ number_format($schedule->price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <a href="{{ route('booking.create', ['schedule_id' => $schedule->id]) }}" 
                                               class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg transition-colors">
                                                <i class="fas fa-ticket-alt mr-2"></i>Book Now
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-gray-800 rounded-lg">
                <i class="fas fa-calendar-times text-6xl text-gray-600 mb-4"></i>
                <h3 class="text-2xl font-semibold mb-2">No Showtimes Available</h3>
                <p class="text-gray-400 mb-6">This movie currently has no scheduled showtimes.</p>
                <a href="{{ route('home') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Browse Other Movies
                </a>
            </div>
        @endif
    </div>
</div>
@endsection