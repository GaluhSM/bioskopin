<x-ui.info-section title="Ringkasan Pembayaran" :border="false">
    <div class="space-y-1">
        <div class="flex justify-between text-gray-400">
            <span>Harga per Kursi:</span>
            <span>Rp {{ number_format($booking->schedule->price, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between text-gray-400">
            <span>Jumlah Kursi:</span>
            <span>{{ $booking->seats->count() }}</span>
        </div>
        <div class="flex justify-between text-white font-bold text-lg border-t border-gray-700 pt-2">
            <span>Total Harga:</span>
            <span class="text-green-400">Rp {{ number_format($booking->schedule->price * $booking->seats->count(), 0, ',', '.') }}</span>
        </div>
    </div>
</x-ui.info-section>