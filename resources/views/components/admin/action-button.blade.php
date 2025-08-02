@php
$variants = [
    'primary' => 'bg-blue-600 hover:bg-blue-700 text-white',
    'success' => 'bg-green-600 hover:bg-green-700 text-white',
    'danger' => 'bg-red-600 hover:bg-red-700 text-white',
    'warning' => 'bg-yellow-600 hover:bg-yellow-700 text-white',
    'secondary' => 'bg-gray-600 hover:bg-gray-700 text-white',
    'outline' => 'border border-gray-600 hover:bg-gray-700 text-gray-300 hover:text-white'
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-xs',
    'md' => 'px-4 py-2 text-sm',
    'lg' => 'px-6 py-3 text-base'
];

$variantClass = $variants[$variant ?? 'primary'] ?? $variants['primary'];
$sizeClass = $sizes[$size ?? 'md'] ?? $sizes['md'];

$classes = "inline-flex items-center font-medium rounded-lg transition-all duration-200 hover:transform hover:-translate-y-0.5 hover:shadow-lg {$variantClass} {$sizeClass}";
@endphp

<{{ $tag ?? 'button' }} 
    {{ $attributes->merge(['class' => $classes]) }}
    @if(isset($href)) href="{{ $href }}" @endif
    @if(isset($onclick)) onclick="{{ $onclick }}" @endif
    @if(isset($type)) type="{{ $type }}" @endif>
    
    @if($icon ?? false)
        <i class="{{ $icon }} mr-2"></i>
    @endif
    
    {{ $slot }}
    
</{{ $tag ?? 'button' }}>