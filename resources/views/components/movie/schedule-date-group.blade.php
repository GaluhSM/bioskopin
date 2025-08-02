<div class="bg-gray-800 rounded-lg p-6">
    <h3 class="text-xl font-bold mb-4 text-blue-400">
        {{ \Carbon\Carbon::parse($date)->format('l, j F Y') }}
    </h3>
    
    @php
        $cinemaSchedules = $schedules->groupBy('studio.cinema.name');
    @endphp
    
    @foreach($cinemaSchedules as $cinemaName => $cinemaScheduleList)
        <x-movie.cinema-schedule-group :cinemaName="$cinemaName" :schedules="$cinemaScheduleList" />
    @endforeach
</div>