<a href="{{ $url }}" class="action-item" style="--accent-color: {{ $accentColor }};">
    <div class="w-10 h-10 bg-{{ $iconColor }}-600 rounded-lg flex items-center justify-center mr-4">
        <i class="{{ $icon }} text-white"></i>
    </div>
    <div>
        <div class="font-medium text-white">{{ $title }}</div>
        <div class="text-sm text-gray-400">{{ $description }}</div>
    </div>
</a>

<style>
.action-item {
    display: flex;
    align-items: center;
    padding: 16px;
    border-radius: 8px;
    background: #111827;
    border: 1px solid #2d3748;
    transition: all 0.2s ease;
    color: #e5e7eb;
    text-decoration: none;
    margin-bottom: 12px;
}

.action-item:hover {
    background: #1e293b;
    border-color: var(--accent-color);
    transform: translateX(4px);
}
</style>