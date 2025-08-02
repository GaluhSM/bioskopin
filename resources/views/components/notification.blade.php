<?php
$typeColors = [
    'error' => 'bg-red-600',
    'warning' => 'bg-yellow-600',
    'success' => 'bg-green-600',
    'info' => 'bg-blue-600'
];

$colorClass = $typeColors[$type] ?? $typeColors['info'];
?>

<div class="fixed top-4 right-4 {{ $colorClass }} text-white px-4 py-3 rounded-lg shadow-lg z-50" 
     id="{{ $id ?? 'notification' }}">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <span>{{ $message }}</span>
        </div>
        <button onclick="this.parentElement.parentElement.remove()" 
                class="ml-4 text-white hover:text-gray-300">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>