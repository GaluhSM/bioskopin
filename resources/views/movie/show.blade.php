<x-app-layout :title="$movie->title . ' - Bioskopin'">
    <div class="bg-gray-900 min-h-screen">
        <x-movie.hero :movie="$movie" />
        <x-movie.schedules-section :schedules="$schedules" />
    </div>
</x-app-layout>