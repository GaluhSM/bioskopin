@php
$baseClasses = 'inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';

$variants = [
    'primary' => 'bg-blue-600 hover:bg-blue-700 text-white focus:ring-blue-500',
    'secondary' => 'bg-gray-600 hover:bg-gray-700 text-white focus:ring-gray-500',
    'success' => 'bg-green-600 hover:bg-green-700 text-white focus:ring-green-500',
    'danger' => 'bg-red-600 hover:bg-red-700 text-white focus:ring-red-500',
    'warning' => 'bg-yellow-600 hover:bg-yellow-700 text-white focus:ring-yellow-500',
    'outline' => 'border border-gray-300 bg-transparent hover:bg-gray-50 text-gray-700 focus:ring-gray-500',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-xs',
    'md' => 'px-4 py-2 text-sm',
    'lg' => 'px-6 py-3 text-base',
    'xl' => 'px-8 py-4 text-lg',
];

$variantClass = $variants[$variant ?? 'primary'] ?? $variants['primary'];
$sizeClass = $sizes[$size ?? 'md'] ?? $sizes['md'];
$fullWidth = ($fullWidth ?? false) ? 'w-full' : '';
$disabled = ($disabled ?? false) ? 'opacity-50 cursor-not-allowed' : '';

$classes = implode(' ', array_filter([$baseClasses, $variantClass, $sizeClass, $fullWidth, $disabled, $class ?? '']));
@endphp

<{{ $tag ?? 'button' }} 
    {{ $attributes->merge(['class' => $classes]) }}
    @if(($disabled ?? false) && ($tag ?? 'button') === 'button') disabled @endif
    @if(isset($type)) type="{{ $type }}" @endif
    @if(isset($href)) href="{{ $href }}" @endif>
    @if($icon ?? false)
        <i class="{{ $icon }} mr-2"></i>
    @endif
    {{ $slot }}
</{{ $tag ?? 'button' }}>