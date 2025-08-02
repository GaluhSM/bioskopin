<div class="lg:col-span-2">
    <x-movie.badges :movie="$movie" />
    
    <h1 class="text-4xl lg:text-5xl font-bold mb-4">{{ $movie->title }}</h1>
    
    <x-movie.metadata :movie="$movie" />
    
    <x-movie.credits :movie="$movie" />
    
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-3">Sinopsis</h3>
        <p class="text-gray-300 leading-relaxed">{{ $movie->synopsis }}</p>
    </div>
</div>