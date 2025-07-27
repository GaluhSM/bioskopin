@extends('layouts.admin')

@section('title', 'Add New Cinema')

@section('content')
<div class="mb-6">
    <div class="flex items-center mb-4">
        <a href="{{ route('admin.cinemas.index') }}" 
           class="text-gray-600 hover:text-gray-900 mr-4">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Add New Cinema</h1>
            <p class="text-gray-600">Create a new cinema location</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.cinemas.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Cinema Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Cinema Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                       placeholder="e.g., Cinema XXI Bandung Supermall"
                       required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                    Location <span class="text-red-500">*</span>
                </label>
                <input type="text" name="location" id="location" value="{{ old('location') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                       placeholder="e.g., Jl. Soekarno Hatta No. 689, Bandung"
                       required>
                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <h3 class="text-sm font-medium text-blue-800 mb-2">
                <i class="fas fa-info-circle mr-2"></i>Information
            </h3>
            <ul class="text-sm text-blue-700 space-y-1">
                <li>• After creating the cinema, you can add studios to it</li>
                <li>• Each studio will automatically generate seats based on its capacity</li>
                <li>• Make sure to use a descriptive name and complete address</li>
            </ul>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t">
            <a href="{{ route('admin.cinemas.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                <i class="fas fa-save mr-2"></i>Create Cinema
            </button>
        </div>
    </form>
</div>
@endsection