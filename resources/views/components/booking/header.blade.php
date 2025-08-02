<div class="bg-gray-800 rounded-lg p-6 mb-8">
    <div class="flex items-center mb-4">
        <a href="{{ route('movie.show', $schedule->movie->id) }}" 
           class="text-gray-400 hover:text-white mr-4">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-2xl font-bold text-white">Booking Tiketmu</h1>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="flex space-x-4">
            @if($schedule->movie->poster_url)
                <img src="{{ $schedule->movie->poster_url }}" 
                     alt="{{ $schedule->movie->title }}"
                     class="w-16 h-24 object-cover rounded">
            @else
                <div class="w-16 h-24 bg-gray-700 rounded flex items-center justify-center">
                    <i class="fas fa-film text-gray-500"></i>
                </div>
            @endif
            <div>
                <h2 class="text-lg font-semibold text-white">{{ $schedule->movie->title }}</h2>
                <p class="text-gray-400 text-sm">{{ $schedule->movie->duration_minutes }} menit • {{ $schedule->movie->audience_rating }}</p>
            </div>
        </div>
        
        <div>
            <h3 class="text-white font-medium mb-1">{{ $schedule->studio->cinema->name }}</h3>
            <p class="text-gray-400 text-sm">{{ $schedule->studio->name }}</p>
            <p class="text-gray-400 text-xs">{{ $schedule->studio->cinema->location }}</p>
        </div>
        
        <div>
            <h3 class="text-white font-medium mb-1">{{ $schedule->start_time->format('l, j F Y') }}</h3>
            <p class="text-gray-400 text-sm">{{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }}</p>
            <p class="text-green-400 font-bold">Rp {{ number_format($schedule->price, 0, ',', '.') }} / kursi</p>
        </div>
    </div>
</div>