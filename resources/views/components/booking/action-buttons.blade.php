<div class="space-y-3">
    <x-ui.button 
        variant="primary" 
        :fullWidth="true" 
        icon="fas fa-print"
        onclick="printTicket()">
        Print Detail Booking
    </x-ui.button>
    
    <x-ui.button 
        variant="success" 
        :fullWidth="true" 
        icon="fas fa-share"
        onclick="shareBooking()">
        Bagikan Booking
    </x-ui.button>
    
    <x-ui.button 
        variant="secondary" 
        :fullWidth="true" 
        icon="fas fa-home"
        tag="a"
        :href="route('home')">
        Kembali ke Beranda
    </x-ui.button>
</div>