<div class="relative bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent">
    <div class="absolute inset-0 bg-cover bg-center opacity-20" 
         style="background-image: url('{{ $movie->poster_url ?? 'https://via.placeholder.com/1920x1080/374151/9CA3AF' }}');"></div>
    <div class="relative max-w-7xl mx-auto px-4 py-16">
        <a href="{{ route('home') }}" title="Kembali ke Beranda"
            class="absolute top-4 left-4 z-10 bg-gray-800/50 hover:bg-gray-700/80 text-white p-3 rounded-full transition-colors duration-300">
            <i class="fas fa-arrow-left"></i>
        </a>
        <br>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <x-movie.poster :movie="$movie" />
            <x-movie.info :movie="$movie" />
        </div>
    </div>
</div>