<section class="relative bg-gradient-to-r from-blue-900 via-purple-900 to-blue-900 py-20">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">
            {{ $title ?? 'Selamat Datang di' }} <span class="text-blue-400">{{ $brandName ?? 'Bioskopin' }}</span>
        </h1>
        <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto">
            {{ $description ?? 'Pesan film favoritmu dengan mudah. Temukan film-film yang sedang tren, cek jadwal tayang, dan pesan tempat dudukmu hanya dengan beberapa klik.' }}
        </p>
        <div class="flex justify-center">
            <x-search-form placeholder="Cari film..." />
        </div>
    </div>
</section>