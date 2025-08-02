@extends('layouts.app')

@section('title', 'Booking Berhasil')

@section('content')
<div class="min-h-screen bg-gray-900 py-12">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-8">
            <div class="bg-green-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check text-3xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Booking Berhasil!</h1>
            <p class="text-gray-400">Tiketmu sudah direservasi. Mohon segera bayar di kasir bioskop.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-xl font-bold text-white mb-4">
                    <i class="fas fa-ticket-alt mr-2 text-blue-400"></i>Detail Booking
                </h2>
                
                <div class="space-y-4">
                    <div class="border-b border-gray-700 pb-4">
                        <h3 class="text-sm font-medium text-gray-400 mb-2">Informasi Pelanggan</h3>
                        <p class="text-white"><span class="text-gray-400">Nama:</span> {{ $booking->customer_name }}</p>
                        <p class="text-white"><span class="text-gray-400">Nomor HP:</span> {{ $booking->customer_phone }}</p>
                        <p class="text-white"><span class="text-gray-400">Kode Booking:</span> 
                            <span class="font-mono text-blue-400">{{ $booking->unique_code }}</span>
                        </p>
                    </div>

                    <div class="border-b border-gray-700 pb-4">
                        <h3 class="text-sm font-medium text-gray-400 mb-2">Informasi Film</h3>
                        <p class="text-white font-semibold">{{ $booking->schedule->movie->title }}</p>
                        <p class="text-gray-400">{{ $booking->schedule->movie->duration_minutes }} menit • {{ $booking->schedule->movie->audience_rating }}</p>
                    </div>

                    <div class="border-b border-gray-700 pb-4">
                        <h3 class="text-sm font-medium text-gray-400 mb-2">Film & Jadwal</h3>
                        <p class="text-white">{{ $booking->schedule->studio->cinema->name }}</p>
                        <p class="text-gray-400">{{ $booking->schedule->studio->name }}</p>
                        <p class="text-gray-400">{{ $booking->schedule->start_time->format('l, j F Y') }}</p>
                        <p class="text-gray-400">{{ $booking->schedule->start_time->format('H:i') }} - {{ $booking->schedule->end_time->format('H:i') }}</p>
                    </div>

                    <div class="border-b border-gray-700 pb-4">
                        <h3 class="text-sm font-medium text-gray-400 mb-2">Kursi yang dipilih</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($booking->seats as $seat)
                                <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm">
                                    {{ $seat->row }}{{ $seat->number }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-400 mb-2">Ringkasan Pembayaran</h3>
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
                    </div>

                    <div class="bg-yellow-900/30 border border-yellow-600 rounded p-3">
                        <div class="flex items-center">
                            <i class="fas fa-clock text-yellow-400 mr-2"></i>
                            <span class="text-yellow-200 font-medium">Status: Pembayaran Tertunda</span>
                        </div>
                        <p class="text-yellow-200 text-sm mt-1">Mohon segera selesaikan pembayaran di kasir bioskop</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-xl font-bold text-white mb-4">
                    <i class="fas fa-qrcode mr-2 text-green-400"></i>Kode QR Pembayaran
                </h2>
                
                <div class="text-center">
                    <div class="bg-white p-6 rounded-lg inline-block mb-4">
                        {!! $qrCode !!}
                    </div>
                    
                    <div class="bg-blue-900/30 border border-blue-600 rounded-lg p-4 mb-4">
                        <h3 class="text-blue-200 font-medium mb-2">
                            <i class="fas fa-info-circle mr-2"></i>Instruksi Pembayaran
                        </h3>
                        <div class="text-blue-200 text-sm space-y-1">
                            <p>1. Bawa QR Code ini ke kasir bioskop</p>
                            <p>2. Perlihatkan QR Codenya ke kasir</p>
                            <p>3. Selesaikan pembayaran</p>
                            <p>4. Dapatkan tiket fisikmu</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <button onclick="printTicket()" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors">
                            <i class="fas fa-print mr-2"></i>Print Detail Booking
                        </button>
                        
                        <button onclick="shareBooking()" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition-colors">
                            <i class="fas fa-share mr-2"></i>Bagikan Booking
                        </button>
                        
                        <a href="{{ route('home') }}" 
                           class="block w-full bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg transition-colors text-center">
                            <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 bg-red-900/30 border border-red-600 rounded-lg p-4">
            <h3 class="text-red-200 font-medium mb-2">
                <i class="fas fa-exclamation-triangle mr-2"></i>Catatan Penting
            </h3>
            <ul class="text-red-200 text-sm space-y-1">
                <li>• Bookingmu hanya valid sampai <strong>30 menit</strong> sebelum jadwal tayang</li>
                <li>• Mohon datang setidaknya <strong>15 menit lebih cepat</strong> untuk menyelesaikan pembayaran</li>
                <li>• Bawa KTP saat akan mengambil tiket</li>
                <li>• Booking ini akan dibatalkan jika pembayaran tidak diselesaikan tepat waktu</li>
            </ul>
        </div>
    </div>
</div>

@push('scripts')
<script>
function printTicket() {
    window.print();
}

function shareBooking() {
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
}
</script>
@endpush
@endsection