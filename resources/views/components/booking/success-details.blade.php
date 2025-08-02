<div class="bg-gray-800 rounded-lg p-6">
    <h2 class="text-xl font-bold text-white mb-4">
        <i class="fas fa-ticket-alt mr-2 text-blue-400"></i>Detail Booking
    </h2>
    
    <div class="space-y-4">
        <x-booking.customer-info :booking="$booking" />
        <x-booking.movie-info :booking="$booking" />
        <x-booking.cinema-info :booking="$booking" />
        <x-booking.seat-info :booking="$booking" />
        <x-booking.payment-summary :booking="$booking" />
        <x-booking.status-info :booking="$booking" />
    </div>
</div>