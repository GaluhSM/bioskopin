<div class="bg-gray-700 rounded-lg p-4 mb-6">
    <h3 class="text-white font-medium mb-3">Ringkasan Booking</h3>
    <div class="space-y-2 text-sm">
        <div class="flex justify-between">
            <span class="text-gray-400">Harga per Kursi:</span>
            <span class="text-white">Rp {{ number_format($schedule->price, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-400">Jumlah Kursi:</span>
            <span class="text-white" id="seat-count">0</span>
        </div>
        <div class="border-t border-gray-600 pt-2 mt-2">
            <div class="flex justify-between font-bold">
                <span class="text-white">Total:</span>
                <span class="text-green-400" id="total-price">Rp 0</span>
            </div>
        </div>
    </div>
</div>