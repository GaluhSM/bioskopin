<div class="bg-gray-800 rounded-lg p-6">
    <h2 class="text-xl font-bold text-white mb-4">
        <i class="fas fa-qrcode mr-2 text-green-400"></i>Kode QR Pembayaran
    </h2>
    
    <div class="text-center">
        <div class="bg-white p-6 rounded-lg inline-block mb-4">
            {!! $qrCode !!}
        </div>
        
        <x-booking.payment-instructions />
        <x-booking.action-buttons :booking="$booking" />
    </div>
</div>