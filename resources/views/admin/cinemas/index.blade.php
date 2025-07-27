@extends('layouts.admin')

@section('title', 'Cinemas Management')
@section('page-title', 'Cinemas')

@push('styles')
<style>
    .cinema-card {
        background: white;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(229, 231, 235, 0.5);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .cinema-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
    }
    
    .cinema-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
    }
    
    .cinema-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    
    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    
    .action-btn:hover {
        transform: translateY(-1px);
    }
    
    .add-cinema-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        font-weight: 600;
    }
    
    .add-cinema-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }
    
    .studios-badge {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }
</style>
@endpush

@section('content')
<!-- Header -->
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-building text-white text-xl"></i>
            </div>
            Cinemas Management
        </h1>
        <p class="text-gray-600 mt-2">Manage all cinema locations and facilities</p>
    </div>
    <a href="{{ route('admin.cinemas.create') }}" class="add-cinema-btn">
        <i class="fas fa-plus mr-2"></i>Add New Cinema
    </a>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 text-green-800 px-6 py-4 rounded-xl mb-6 flex items-center">
        <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
@endif

<!-- Cinemas Grid -->
@if($cinemas->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($cinemas as $cinema)
        <div class="cinema-card">
            <!-- Cinema Icon -->
            <div class="cinema-icon">
                <i class="fas fa-building text-white text-2xl"></i>
            </div>
            
            <!-- Cinema Info -->
            <div class="mb-6">
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $cinema->name }}</h3>
                <div class="flex items-start text-gray-600 mb-4">
                    <i class="fas fa-map-marker-alt mr-2 mt-1 text-gray-400"></i>
                    <p class="text-sm leading-relaxed">{{ $cinema->location }}</p>
                </div>
                
                <!-- Studios Badge -->
                <div class="flex items-center justify-between">
                    <span class="studios-badge">
                        <i class="fas fa-door-open mr-2"></i>
                        {{ $cinema->studios_count }} Studios
                    </span>
                    <span class="text-xs text-gray-500">
                        Created {{ $cinema->created_at->format('M j, Y') }}
                    </span>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="flex items-center justify-center space-x-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.cinemas.show', $cinema) }}" 
                   class="action-btn bg-blue-100 text-blue-600 hover:bg-blue-200" 
                   title="View Details">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('admin.cinemas.edit', $cinema) }}" 
                   class="action-btn bg-indigo-100 text-indigo-600 hover:bg-indigo-200" 
                   title="Edit Cinema">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.cinemas.destroy', $cinema) }}" 
                      method="POST" class="inline" 
                      onsubmit="return confirm('Are you sure? This will also delete all studios and seats in this cinema.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="action-btn bg-red-100 text-red-600 hover:bg-red-200" 
                            title="Delete Cinema">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    @if($cinemas->hasPages())
        <div class="mt-8 flex justify-center">
            <div class="bg-white rounded-xl p-4 shadow-lg">
                {{ $cinemas->links() }}
            </div>
        </div>
    @endif
@else
    <!-- Empty State -->
    <div class="text-center py-16">
        <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-building text-gray-400 text-5xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4">No Cinemas Found</h3>
        <p class="text-gray-600 mb-8 max-w-md mx-auto">
            Start by adding your first cinema location. You can manage all cinema facilities and studios from here.
        </p>
        <a href="{{ route('admin.cinemas.create') }}" class="add-cinema-btn inline-flex">
            <i class="fas fa-plus mr-2"></i>Add Your First Cinema
        </a>
    </div>
@endif
@endsection