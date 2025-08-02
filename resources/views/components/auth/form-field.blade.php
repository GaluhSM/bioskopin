<div class="mb-6">
    <label for="{{ $name }}" class="block text-white text-sm font-medium mb-2">
        <i class="{{ $icon }} mr-2"></i>{{ $label }}
    </label>
    <input type="{{ $type }}" 
           name="{{ $name }}" 
           id="{{ $name }}"
           value="{{ $value ?? '' }}"
           class="w-full px-4 py-3 bg-white/20 backdrop-blur-sm text-white placeholder-gray-300 rounded-lg border border-white/30 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
           placeholder="{{ $placeholder }}"
           {{ $required ?? false ? 'required' : '' }}>
    @error($name)
        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>