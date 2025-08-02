<div class="card-container {{ $class ?? '' }}">
    @if($title ?? false)
        <div class="card-header">
            @if($icon ?? false)
                <div class="w-10 h-10 bg-{{ $iconColor ?? 'blue' }}-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="{{ $icon }} text-white"></i>
                </div>
            @endif
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-white">{{ $title }}</h3>
                @if($subtitle ?? false)
                    <p class="text-sm text-gray-400">{{ $subtitle }}</p>
                @endif
            </div>
            @if($headerAction ?? false)
                <div class="ml-4">
                    {{ $headerAction }}
                </div>
            @endif
        </div>
    @endif
    
    <div class="card-content">
        {{ $slot }}
    </div>
</div>

<style>
.card-container {
    background: #1f2937;
    border: 1px solid #374151;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.card-header {
    background: #111827;
    border-bottom: 1px solid #374151;
    padding: 20px 24px;
    display: flex;
    align-items: center;
}

.card-content {
    padding: 24px;
}
</style>