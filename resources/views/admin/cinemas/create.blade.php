@extends('layouts.admin')

@section('title', 'Add New Cinema')
@section('page-title', 'Add Cinema')

@push('styles')
<style>
    .form-container {
        background: white;
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(229, 231, 235, 0.5);
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        transition: all 0.2s ease;
        font-size: 14px;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .required {
        color: #ef4444;
    }
    
    .info-box {
        background: linear-gradient(135deg, #dbeafe 0%, #e0e7ff 100%);
        border: 1px solid #bfdbfe;
        border-radius: 16px;
        padding: 20px;
        margin-top: 24px;
    }
    
    .submit-btn {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }
    
    .cancel-btn {
        background: #f3f4f6;
        color: #374151;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-block;
    }
    
    .cancel-btn:hover {
        background: #e5e7eb;
        transform: translateY(-1px);
    }
</style>
@endpush

@section('content')
<!-- Header -->
<div class="mb-8">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.cinemas.index') }}" 
           class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center justify-center mr-4 transition-colors">
            <i class="fas fa-arrow-left text-gray-600"></i>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-plus text-white text-xl"></i>
                </div>
                Add New Cinema
            </h1>
            <p class="text-gray-600 mt-2">Create a new cinema location in your network</p>
        </div>
    </div>
</div>

<div class="form-container">
    <form action="{{ route('admin.cinemas.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Cinema Name -->
            <div class="form-group">
                <label for="name" class="form-label">
                    Cinema Name <span class="required">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="form-input @error('name') border-red-300 @enderror"
                       placeholder="e.g., Cinema XXI Bandung Supermall"
                       required>
                <p class="text-gray-500 text-sm mt-2">Enter a descriptive name for the cinema location</p>
                @error('name')
                    <p class="text-red-500 text-sm mt-2 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Location -->
            <div class="form-group">
                <label for="location" class="form-label">
                    Location Address <span class="required">*</span>
                </label>
                <input type="text" name="location" id="location" value="{{ old('location') }}"
                       class="form-input @error('location') border-red-300 @enderror"
                       placeholder="e.g., Jl. Soekarno Hatta No. 689, Bandung"
                       required>
                <p class="text-gray-500 text-sm mt-2">Complete address including city and postal code</p>
                @error('location')
                    <p class="text-red-500 text-sm mt-2 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <!-- Info Box -->
        <div class="info-box">
            <h3 class="text-sm font-semibold text-blue-800 mb-3 flex items-center">
                <i class="fas fa-info-circle mr-2"></i>Cinema Setup Information
            </h3>
            <ul class="text-sm text-blue-700 space-y-2">
                <li class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-600"></i>
                    After creating the cinema, you can add multiple studios to it
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-600"></i>
                    Each studio will automatically generate seats based on its capacity
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-600"></i>
                    Use a descriptive name that customers can easily recognize
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-600"></i>
                    Provide complete address information for accurate location services
                </li>
            </ul>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.cinemas.index') }}" class="cancel-btn">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" class="submit-btn">
                <i class="fas fa-save mr-2"></i>Create Cinema
            </button>
        </div>
    </form>
</div>
@endsection