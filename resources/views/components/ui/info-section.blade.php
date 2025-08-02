@php
$borderClass = $border ?? true ? 'border-b border-gray-700 pb-4' : '';
@endphp

<div class="{{ $borderClass }}">
    <h3 class="text-sm font-medium text-gray-400 mb-2">{{ $title }}</h3>
    {{ $slot }}
</div>