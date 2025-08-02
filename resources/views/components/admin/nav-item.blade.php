<?php
$isActive = request()->routeIs($route);
$url = $href ?? route($route);
?>

<a href="{{ $url }}" 
   class="nav-item {{ $isActive ? 'active' : '' }} flex items-center px-3 py-3 text-slate-300 rounded-lg mb-2">
    <div class="nav-icon mr-3" style="--icon-bg: {{ $iconBg }};">
        <i class="{{ $icon }} {{ $iconColor }}"></i>
    </div>
    <span class="font-medium">{{ $label }}</span>
</a>