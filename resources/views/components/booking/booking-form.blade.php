<div class="lg:col-span-1">
    <div class="bg-gray-800 rounded-lg p-6 sticky top-8">
        <h2 class="text-xl font-bold text-white mb-6">Detail Booking</h2>
        
        <form action="{{ route('booking.store') }}" method="POST" id="booking-form">
            @csrf
            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
            <div id="seat-inputs-container"></div>
            
            <x-booking.selected-seats />
            
            <x-booking.customer-form />
            
            <x-booking.summary :schedule="$schedule" />
            
            <button type="submit" id="submit-btn"
                    class="w-full bg-blue-600 hover:bg-blue-700 disabled:bg-gray-600 disabled:cursor-not-allowed text-white font-bold py-3 px-4 rounded-lg transition-colors"
                    disabled>
                <i class="fas fa-ticket-alt mr-2"></i>Booking Sekarang
            </button>
            
            <x-booking.notice />
        </form>
    </div>
</div>