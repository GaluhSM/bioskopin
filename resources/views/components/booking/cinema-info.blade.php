<x-ui.info-section title="Film & Jadwal">
    <p class="text-white">{{ $booking->schedule->studio->cinema->name }}</p>
    <p class="text-gray-400">{{ $booking->schedule->studio->name }}</p>
    <p class="text-gray-400">{{ $booking->schedule->start_time->format('l, j F Y') }}</p>
    <p class="text-gray-400">{{ $booking->schedule->start_time->format('H:i') }} - {{ $booking->schedule->end_time->format('H:i') }}</p>
</x-ui.info-section>