<nav class="bg-gray-800 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-400">
                    <i class="fas fa-film mr-2"></i>Bioskopin
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <x-search-form />
            </div>
        </div>
    </div>
</nav>