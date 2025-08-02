<div class="mb-8">
    <h1 class="text-3xl font-bold mb-4">
        @if($query)
            Hasil Pencarian untuk "<span class="text-blue-400">{{ $query }}</span>"
        @else
            Semua Film
        @endif
    </h1>
    <p class="text-gray-400">{{ $totalMovies }} film ditemukan</p>
</div>