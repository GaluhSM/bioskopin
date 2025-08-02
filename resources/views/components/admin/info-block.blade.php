<div class="info-block text-center">
    <div class="w-12 h-12 bg-{{ $iconColor }}-600 rounded-full flex items-center justify-center mx-auto mb-3">
        <i class="{{ $icon }} text-white"></i>
    </div>
    <div class="text-2xl font-bold text-white mb-1">{{ $value }}</div>
    <div class="text-gray-400 text-sm">{{ $label }}</div>
</div>

<style>
.info-block {
    background: #111827;
    border: 1px solid #2d3748;
    border-radius: 10px;
    padding: 20px;
}
</style>