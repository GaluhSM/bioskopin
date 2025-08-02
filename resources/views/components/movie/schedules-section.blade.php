<div class="max-w-7xl mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold mb-8">
        <i class="fas fa-calendar-alt mr-3 text-blue-400"></i>Jadwal Tayang & Tiket
    </h2>
    
    @if($schedules->count() > 0)
        <div class="grid gap-6">
            @php
                $groupedSchedules = $schedules->groupBy(function($schedule) {
                    return $schedule->start_time->format('Y-m-d');
                });
            @endphp
            
            @foreach($groupedSchedules as $date => $dateSchedules)
                <x-movie.schedule-date-group :date="$date" :schedules="$dateSchedules" />
            @endforeach
        </div>
    @else
        <x-movie.no-schedules />
    @endif
</div>