<form action="{{ route('search') }}" method="GET" class="flex">
    <input type="text" 
           name="q" 
           placeholder="{{ $placeholder ?? 'Cari Film...' }}" 
           value="{{ request('q') }}"
           class="px-4 py-2 bg-gray-700 text-white rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-r-lg">
        <i class="fas fa-search"></i>
    </button>
</form>