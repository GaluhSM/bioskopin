<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-white flex items-center mb-2">
            <div class="w-12 h-12 bg-{{ $iconColor ?? 'blue' }}-600 rounded-xl flex items-center justify-center mr-4">
                <i class="{{ $icon }} text-white text-xl"></i>
            </div>
            {{ $title }}
        </h1>
        @if($description ?? false)
            <p class="text-gray-400">{{ $description }}</p>
        @endif
    </div>
    
    @if($showDateTime ?? false)
        <div class="text-right text-gray-400">
            <div class="text-lg font-semibold">{{ now()->format('H:i') }}</div>
            <div class="text-sm">{{ now()->format('l, j F Y') }}</div>
        </div>
    @endif
    
    @if($action ?? false)
        <div class="flex items-center space-x-3">
            {{ $action }}
        </div>
    @endif
</div>