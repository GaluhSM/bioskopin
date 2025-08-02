<div class="mb-8">
    <form action="{{ route('search') }}" method="GET" class="flex max-w-md">
        <input type="text" name="q" placeholder="Cari Film" 
               value="{{ $query }}"
               class="flex-1 px-4 py-3 bg-gray-800 text-white border border-gray-700 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-r-lg transition-colors">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>