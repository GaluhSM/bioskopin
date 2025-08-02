<section class="py-16 bg-gray-800">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">{{ $title ?? 'Kenapa Harus Bioskopin?' }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <x-feature-item 
                icon="fas fa-clock"
                color="blue"
                title="Booking Kilat"
                description="Pesan tiketmu dengan mudah hanya dalam beberapa klik tanpa repot." />
            
            <x-feature-item 
                icon="fas fa-couch"
                color="green"
                title="Pilih Kursimu"
                description="Pilih kursi favoritmu dari diagram tempat duduk interaktif kami." />
            
            <x-feature-item 
                icon="fas fa-qrcode"
                color="purple"
                title="Tiket QR Coded"
                description="Dapatkan tiketmu secara instant dengan kode QR yang aman." />
        </div>
    </div>
</section>