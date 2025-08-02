<script>
function printTicket() {
    window.print();
}

function shareBooking() {
    @if(isset($booking))
    if (navigator.share) {
        navigator.share({
            title: 'Movie Booking - {{ $booking->schedule->movie->title }}',
            text: 'Booking Code: {{ $booking->unique_code }}\nMovie: {{ $booking->schedule->movie->title }}\nDate: {{ $booking->schedule->start_time->format("l, j F Y") }}\nTime: {{ $booking->schedule->start_time->format("H:i") }}',
            url: window.location.href
        });
    } else {
        const bookingDetails = `Booking Code: {{ $booking->unique_code }}\nMovie: {{ $booking->schedule->movie->title }}\nDate: {{ $booking->schedule->start_time->format("l, j F Y") }}\nTime: {{ $booking->schedule->start_time->format("H:i") }}\nCinema: {{ $booking->schedule->studio->cinema->name }}`;
        
        navigator.clipboard.writeText(bookingDetails).then(() => {
            alert('Booking details copied to clipboard!');
        });
    }
    @endif
}
</script>