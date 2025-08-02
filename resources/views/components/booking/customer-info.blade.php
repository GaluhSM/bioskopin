<x-ui.info-section title="Informasi Pelanggan">
    <p class="text-white"><span class="text-gray-400">Nama:</span> {{ $booking->customer_name }}</p>
    <p class="text-white"><span class="text-gray-400">Nomor HP:</span> {{ $booking->customer_phone }}</p>
    <p class="text-white"><span class="text-gray-400">Kode Booking:</span> 
        <span class="font-mono text-blue-400">{{ $booking->unique_code }}</span>
    </p>
</x-ui.info-section>