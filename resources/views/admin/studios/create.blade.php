@extends('layouts.admin')

@section('title', 'Create Studio')
@section('page-title', 'Create Studio')

@push('styles')
<style>
    .studio-form-container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        padding: 0;
    }

    .form-card {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }
    
    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #8b5cf6, #7c3aed);
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: block;
        color: #f9fafb;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }
    
    .form-input {
        width: 100%;
        background: #374151;
        border: 1px solid #4b5563;
        border-radius: 12px;
        padding: 12px 16px;
        color: #f9fafb;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        background: #4b5563;
    }
    
    .form-select {
        width: 100%;
        background: #374151;
        border: 1px solid #4b5563;
        border-radius: 12px;
        padding: 12px 16px;
        color: #f9fafb;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px;
        padding-right: 40px;
    }
    
    .form-select:focus {
        outline: none;
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        background: #4b5563;
    }
    
    .error-message {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 6px;
        display: flex;
        align-items: center;
    }
    
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid #374151;
    }
    
    .btn {
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.95rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
    }
    
    .btn-secondary {
        background: #374151;
        color: #9ca3af;
        border: 1px solid #4b5563;
    }
    
    .btn-secondary:hover {
        background: #4b5563;
        color: #f9fafb;
        transform: translateY(-1px);
    }
    
    .form-help {
        color: #9ca3af;
        font-size: 0.85rem;
        margin-top: 6px;
    }
    
    .studio-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
    }
</style>
@endpush

@section('content')
<div class="studio-form-container">
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="studio-icon">
            <i class="fas fa-door-open text-white text-3xl"></i>
        </div>
        <h1 class="text-3xl font-bold text-white mb-2">Create New Studio</h1>
        <p class="text-gray-400">Add a new studio to your cinema with automatic seat generation</p>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('admin.studios.store') }}" method="POST">
            @csrf
            
            <!-- Cinema Selection -->
            <div class="form-group">
                <label for="cinema_id" class="form-label">
                    <i class="fas fa-building mr-2 text-purple-400"></i>
                    Select Cinema
                </label>
                <select name="cinema_id" id="cinema_id" class="form-select @error('cinema_id') border-red-500 @enderror" required>
                    <option value="">Choose a cinema...</option>
                    @foreach($cinemas as $cinema)
                        <option value="{{ $cinema->id }}" {{ old('cinema_id') == $cinema->id ? 'selected' : '' }}>
                            {{ $cinema->name }} - {{ $cinema->location }}
                        </option>
                    @endforeach
                </select>
                @error('cinema_id')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-help">
                    Select the cinema where this studio will be located
                </div>
            </div>

            <!-- Studio Name -->
            <div class="form-group">
                <label for="name" class="form-label">
                    <i class="fas fa-tag mr-2 text-purple-400"></i>
                    Studio Name
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       class="form-input @error('name') border-red-500 @enderror" 
                       value="{{ old('name') }}" 
                       placeholder="e.g., Studio A, Premium Hall 1, etc."
                       required>
                @error('name')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-help">
                    Enter a unique name for this studio (max 255 characters)
                </div>
            </div>

            <!-- Capacity -->
            <div class="form-group">
                <label for="capacity" class="form-label">
                    <i class="fas fa-couch mr-2 text-purple-400"></i>
                    Seating Capacity
                </label>
                <input type="number" 
                       name="capacity" 
                       id="capacity" 
                       class="form-input @error('capacity') border-red-500 @enderror" 
                       value="{{ old('capacity') }}" 
                       min="1" 
                       max="200" 
                       placeholder="Enter total number of seats"
                       required>
                @error('capacity')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-help">
                    Total number of seats (1-200). Seats will be automatically generated in rows A-J
                </div>
            </div>

            <!-- Capacity Preview -->
            <div class="bg-gray-700 border border-gray-600 rounded-xl p-4 mb-6">
                <h4 class="text-white font-semibold mb-2 flex items-center">
                    <i class="fas fa-info-circle text-blue-400 mr-2"></i>
                    Seat Generation Preview
                </h4>
                <p class="text-gray-300 text-sm mb-2">
                    Seats will be automatically distributed across rows A through J based on your capacity setting.
                </p>
                <div class="text-xs text-gray-400">
                    <i class="fas fa-lightbulb mr-1"></i>
                    <strong>Example:</strong> 50 seats = 5 seats per row across 10 rows (A1-A5, B1-B5, etc.)
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('admin.studios.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i>
                    Create Studio
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const capacityInput = document.getElementById('capacity');
    const previewSection = document.querySelector('.bg-gray-700');
    
    capacityInput.addEventListener('input', function() {
        const capacity = parseInt(this.value) || 0;
        if (capacity > 0) {
            const rowCount = Math.min(10, Math.ceil(capacity / 10));
            const seatsPerRow = Math.ceil(capacity / rowCount);
            
            const exampleText = previewSection.querySelector('.text-xs');
            const rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
            const exampleRows = rows.slice(0, Math.min(3, rowCount));
            
            exampleText.innerHTML = `
                <i class="fas fa-lightbulb mr-1"></i>
                <strong>Preview:</strong> ${capacity} seats ≈ ${seatsPerRow} seats per row across ${rowCount} rows 
                (${exampleRows.join('1-' + seatsPerRow + ', ')}1-${seatsPerRow}${rowCount > 3 ? ', ...' : ''})
            `;
        }
    });
});
</script>
@endsection