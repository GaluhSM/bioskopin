<x-app-layout title="Hasil Pencarian - Bioskopin">
    <div class="py-8 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            <x-search.header :query="$query" :totalMovies="$movies->total()" />
            <x-search.form :query="$query" />
            <x-search.results :movies="$movies" :query="$query" />
        </div>
    </div>
</x-app-layout>