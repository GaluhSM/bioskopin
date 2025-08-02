<?php
$statusColors = [
    'pending_payment' => 'bg-yellow-900 text-yellow-300',
    'paid' => 'bg-green-900 text-green-300',
    'cancelled' => 'bg-red-900 text-red-300',
    'default' => 'bg-gray-700 text-gray-300'
];

$colorClass = $statusColors[$status] ?? $statusColors['default'];
?>

<span class="status-pill {{ $colorClass }}">
    {{ $label ?? ucfirst(str_replace('_', ' ', $status)) }}
</span>

<style>
.status-pill {
    padding: 6px 12px;
    border-radius: 16px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
</style>