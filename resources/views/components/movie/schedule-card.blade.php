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
        <i class="fas fa-ticket-alt mr-2"></i>Pesan Sekarang
    </a>
</div>