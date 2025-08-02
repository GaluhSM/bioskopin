@php
$inputClasses = 'w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors';
@endphp

<div class="{{ $containerClass ?? 'mb-6' }}">
    <label for="{{ $name }}" class="block text-sm font-medium text-white mb-2">
        @if($icon ?? false)
            <i class="{{ $icon }} mr-2 text-gray-400"></i>
        @endif
        {{ $label }}
        @if($required ?? false)
            <span class="text-red-400">*</span>
        @endif
    </label>
    
    @if($type === 'textarea')
        <textarea 
            name="{{ $name }}" 
            id="{{ $name }}"
            rows="{{ $rows ?? 4 }}"
            class="{{ $inputClasses }}"
            placeholder="{{ $placeholder ?? '' }}"
            {{ ($required ?? false) ? 'required' : '' }}
            {{ $attributes }}>{{ $value ?? old($name) }}</textarea>
    @elseif($type === 'select')
        <select 
            name="{{ $name }}" 
            id="{{ $name }}"
            class="{{ $inputClasses }}"
            {{ ($required ?? false) ? 'required' : '' }}
            {{ $attributes }}>
            @if($placeholder ?? false)
                <option value="">{{ $placeholder }}</option>
            @endif
            {{ $slot }}
        </select>
    @else
        <input 
            type="{{ $type ?? 'text' }}" 
            name="{{ $name }}" 
            id="{{ $name }}"
            value="{{ $value ?? old($name) }}"
            class="{{ $inputClasses }}"
            placeholder="{{ $placeholder ?? '' }}"
            {{ ($required ?? false) ? 'required' : '' }}
            {{ $attributes }}>
    @endif
    
    @error($name)
        <p class="text-red-400 text-sm mt-2 flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
        </p>
    @enderror
</div>