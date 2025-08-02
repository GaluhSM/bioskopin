@if($movies->count() > 0)
<section class="py-16 bg-{{ $bgColor ?? 'gray-900' }}">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center mb-8">
            <i class="{{ $icon }} text-{{ $iconColor }}-500 text-2xl mr-3"></i>
            <h2 class="text-3xl font-bold">{{ $title }}</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach($movies as $movie)
                <x-movie-card :movie="$movie" />
            @endforeach
        </div>
    </div>
</section>
@endif