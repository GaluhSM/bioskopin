<div class="metric-card" style="--accent-color: {{ $accentColor }}; --icon-bg: {{ $iconBg }};">
    <div class="metric-icon">
        <i class="{{ $icon }} text-xl"></i>
    </div>
    <div class="text-3xl font-bold text-white mb-1">{{ $value }}</div>
    <div class="text-gray-400 text-sm">{{ $label }}</div>
</div>

<style>
.metric-card {
    background: #1f2937;
    border: 1px solid #374151;
    border-radius: 12px;
    padding: 24px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.metric-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--accent-color);
}

.metric-card:hover {
    background: #243447;
    border-color: #4b5563;
    transform: translateY(-2px);
}

.metric-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--icon-bg);
    color: var(--accent-color);
    margin-bottom: 16px;
}
</style>