<div class="table-header">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-{{ $iconColor ?? 'blue' }}-600 rounded-lg flex items-center justify-center mr-3">
                <i class="{{ $icon }} text-white"></i>
            </div>
            <h3 class="text-lg font-semibold text-white">{{ $title }}</h3>
        </div>
        @if($viewAllUrl ?? false)
            <a href="{{ $viewAllUrl }}" class="text-blue-400 hover:text-blue-300 font-medium text-sm transition-colors">
                {{ $viewAllText ?? 'Lihat Semua' }} <i class="fas fa-arrow-right ml-1"></i>
            </a>
        @endif
        @if($action ?? false)
            {{ $action }}
        @endif
    </div>
</div>

<style>
.table-header {
    background: #111827;
    border-bottom: 1px solid #374151;
    padding: 20px 24px;
}
</style>