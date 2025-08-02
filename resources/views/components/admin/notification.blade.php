@php
$typeClasses = [
    'success' => 'bg-green-600 border-green-500',
    'error' => 'bg-red-600 border-red-500',
    'warning' => 'bg-yellow-600 border-yellow-500',
    'info' => 'bg-blue-600 border-blue-500'
];

$icons = [
    'success' => 'fas fa-check-circle',
    'error' => 'fas fa-exclamation-circle',
    'warning' => 'fas fa-exclamation-triangle',
    'info' => 'fas fa-info-circle'
];

$colorClass = $typeClasses[$type ?? 'info'] ?? $typeClasses['info'];
$iconClass = $icons[$type ?? 'info'] ?? $icons['info'];
@endphp

<div class="notification {{ $colorClass }} text-white px-4 py-3 rounded-lg shadow-lg border-l-4 {{ $class ?? '' }}" 
     id="{{ $id ?? 'notification-' . uniqid() }}">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <i class="{{ $iconClass }} mr-3"></i>
            <div>
                @if($title ?? false)
                    <h4 class="font-semibold">{{ $title }}</h4>
                @endif
                <p class="{{ ($title ?? false) ? 'text-sm' : '' }}">{{ $message }}</p>
            </div>
        </div>
        @if($dismissible ?? true)
            <button onclick="this.parentElement.parentElement.remove()" 
                    class="ml-4 text-white hover:text-gray-200 transition-colors p-1 hover:bg-white/20 rounded">
                <i class="fas fa-times text-sm"></i>
            </button>
        @endif
    </div>
    
    @if($autoHide ?? true)
        <script>
            setTimeout(() => {
                const notification = document.getElementById('{{ $id ?? 'notification-' . uniqid() }}');
                if (notification) {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => notification.remove(), 300);
                }
            }, {{ $duration ?? 5000 }});
        </script>
    @endif
</div>

<style>
.notification {
    transition: all 0.3s ease;
}
</style>