<div class="mb-6 last:mb-0">
    <h4 class="text-lg font-semibold mb-3 text-gray-300">
        <i class="fas fa-map-marker-alt mr-2"></i>{{ $cinemaName }}
        <span class="text-sm text-gray-400 ml-2">
            ({{ $schedules->first()->studio->cinema->location }})
        </span>
    </h4>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($schedules as $schedule)
            <x-movie.schedule-card :schedule="$schedule" />
        @endforeach
    </div>
</div>