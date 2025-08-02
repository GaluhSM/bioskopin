<div class="data-table">
    <div class="table-header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-{{ $iconColor }}-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="{{ $icon }} text-white"></i>
                </div>
                <h3 class="text-lg font-semibold text-white">{{ $title }}</h3>
            </div>
            @if($viewAllUrl ?? false)
                <a href="{{ $viewAllUrl }}" class="text-blue-400 hover:text-blue-300 font-medium text-sm">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            @endif
        </div>
    </div>
    
    <div class="overflow-x-auto">
        {{ $slot }}
    </div>
</div>

<style>
.data-table {
    background: #1f2937;
    border: 1px solid #374151;
    border-radius: 12px;
    overflow: hidden;
}

.table-header {
    background: #111827;
    border-bottom: 1px solid #374151;
    padding: 20px;
}

.table thead {
    background: #0f172a;
}

.table tbody tr {
    background: #1f2937;
    border-bottom: 1px solid #2d3748;
}

.table tbody tr:hover {
    background: #243447;
}
</style>