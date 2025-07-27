@extends('layouts.admin')

@section('title', 'Movies Management')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Movies Management</h1>
        <p class="text-gray-600">Manage all movies in the system</p>
    </div>
    <a href="{{ route('admin.movies.create') }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
        <i class="fas fa-plus mr-2"></i>Add New Movie
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Movie</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Release</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($movies as $movie)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-16 w-12">
                                @if($movie->poster_url)
                                    <img class="h-16 w-12 object-cover rounded" 
                                         src="{{ asset('storage/' . $movie->poster_url) }}" 
                                         alt="{{ $movie->title }}">
                                @else
                                    <div class="h-16 w-12 bg-gray-300 rounded flex items-center justify-center">
                                        <i class="fas fa-film text-gray-500"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $movie->title }}</div>
                                <div class="text-sm text-gray-500">{{ $movie->audience_rating }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $movie->duration_minutes }} minutes</div>
                        <div class="text-sm text-gray-500">
                            @if($movie->rating)
                                <i class="fas fa-star text-yellow-400"></i> {{ $movie->rating }}/10
                            @else
                                No rating
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $movie->release_date->format('M j, Y') }}</div>
                        <div class="text-sm text-gray-500">{{ $movie->producer }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($movie->is_trending)
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-fire mr-1"></i>Trending
                            </span>
                        @else
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                Regular
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('admin.movies.show', $movie) }}" 
                           class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.movies.edit', $movie) }}" 
                           class="text-indigo-600 hover:text-indigo-900">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.movies.destroy', $movie) }}" 
                              method="POST" class="inline" 
                              onsubmit="return confirm('Are you sure you want to delete this movie?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No movies found. <a href="{{ route('admin.movies.create') }}" class="text-blue-600">Add the first movie</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($movies->hasPages())
        <div class="px-6 py-3 border-t border-gray-200">
            {{ $movies->links() }}
        </div>
    @endif
</div>
@endsection