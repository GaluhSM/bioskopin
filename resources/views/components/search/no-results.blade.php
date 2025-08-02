<div class="text-center py-16">
    <i class="fas fa-search text-6xl text-gray-600 mb-4"></i>
    <h2 class="text-2xl font-semibold mb-2">Tidak ada Film yang ditemukan</h2>
    <p class="text-gray-400 mb-6">
        @if($query)
            Kami tidak bisa menemukan film yang sesuai dengan "{{ $query }}". Coba cari dengan kata kunci yang berbeda.
        @else
            Tidak ada film yang tersedia di saat ini.
        @endif
    </p>
    <a href="{{ route('home') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors">
        <i class="fas fa-home mr-2"></i>Kembali ke Beranda
    </a>
</div>