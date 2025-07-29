@extends('layouts.admin')

@section('title', 'Studios Management')
@section('page-title', 'Studios')

@push('styles')
<style>
    .studios-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }

    .studio-card {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .studio-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #8b5cf6, #7c3aed);
    }
    
    .studio-card:hover {
        background: #243447;
        border-color: #4b5563;
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
    }
    
    .studio-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
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
    
    .add-studio-btn {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        font-weight: 600;
    }
    
    .add-studio-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
    }
    
    .capacity-badge {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }
    
    .cinema-tag {
        background: #374151;
        color: #9ca3af;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }
</style>
@endpush

@section('content')
<div class="studios-container">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-door-open text-white text-xl"></i>
                </div>
                Studios Management
            </h1>
            <p class="text-gray-400 mt-2">Manage all cinema studios and their seating arrangements</p>
        </div>
        <a href="{{ route('admin.studios.create') }}" class="add-studio-btn">
            <i class="fas fa-plus mr-2"></i>Add New Studio
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 text-green-800 px-6 py-4 rounded-xl mb-6 flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Studios Grid -->
    @if($studios && $studios->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($studios as $studio)
            <div class="studio-card">
                <!-- Studio Icon -->
                <div class="studio-icon">
                    <i class="fas fa-door-open text-white text-2xl"></i>
                </div>
                
                <!-- Studio Info -->
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-white mb-3">{{ $studio->name }}</h3>
                    
                    <!-- Cinema Tag -->
                    <div class="cinema-tag mb-4">
                        <i class="fas fa-building mr-1"></i>
                        {{ $studio->cinema->name }}
                    </div>
                    
                    <div class="flex items-start text-gray-300 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 mt-1 text-gray-400"></i>
                        <p class="text-sm leading-relaxed">{{ $studio->cinema->location }}</p>
                    </div>
                    
                    <!-- Capacity & Seats Info -->
                    <div class="flex items-center justify-between">
                        <span class="capacity-badge">
                            <i class="fas fa-couch mr-2"></i>
                            {{ $studio->seats_count ?? 0 }} Seats
                        </span>
                        <span class="text-xs text-gray-400">
                            Capacity: {{ $studio->capacity }}
                        </span>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center justify-center space-x-3 pt-6 border-t border-gray-600">
                    <a href="{{ route('admin.studios.show', $studio) }}" 
                       class="action-btn bg-blue-700 text-blue-300 hover:bg-blue-600" 
                       title="View Studio Layout">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.studios.edit', $studio) }}" 
                       class="action-btn bg-indigo-700 text-indigo-300 hover:bg-indigo-600" 
                       title="Edit Studio">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.studios.destroy', $studio) }}" 
                          method="POST" class="inline" 
                          onsubmit="return confirm('Are you sure? This will also delete all seats and schedules in this studio.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="action-btn bg-red-700 text-red-300 hover:bg-red-600" 
                                title="Delete Studio">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($studios->hasPages())
            <div class="mt-8 flex justify-center">
                <div class="bg-gray-800 rounded-xl p-4 shadow-lg">
                    {{ $studios->links() }}
                </div>
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-32 h-32 bg-gradient-to-br from-gray-700 to-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-door-open text-gray-400 text-5xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-white mb-4">No Studios Found</h3>
            <p class="text-gray-400 mb-8 max-w-md mx-auto">
                Start by adding your first studio. You can manage seating arrangements and studio configurations from here.
            </p>
            <a href="{{ route('admin.studios.create') }}" class="add-studio-btn inline-flex">
                <i class="fas fa-plus mr-2"></i>Add Your First Studio
            </a>
        </div>
    @endif
</div>
@endsection