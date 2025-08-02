<div class="action-grid">
    <div class="flex items-center mb-6">
        <div class="w-10 h-10 bg-{{ $headerIconColor }}-600 rounded-lg flex items-center justify-center mr-3">
            <i class="{{ $headerIcon }} text-white"></i>
        </div>
        <h3 class="text-lg font-semibold text-white">{{ $title }}</h3>
    </div>
    
    {{ $slot }}
</div>

<style>
.action-grid {
    background: #1f2937;
    border: 1px solid #374151;
    border-radius: 12px;
    padding: 24px;
}
</style>