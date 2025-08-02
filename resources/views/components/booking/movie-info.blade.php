<x-ui.info-section title="Informasi Film">
    <p class="text-white font-semibold">{{ $booking->schedule->movie->title }}</p>
    <p class="text-gray-400">{{ $booking->schedule->movie->duration_minutes }} menit • {{ $booking->schedule->movie->audience_rating }}</p>
</x-ui.info-section>