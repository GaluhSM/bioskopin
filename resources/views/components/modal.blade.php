<div id="{{ $id }}" class="fixed inset-0 modal-backdrop hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 w-11/12 md:w-3/4 lg:w-1/2 modal-content shadow-2xl">
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-600">
            <h3 class="text-xl font-semibold text-white flex items-center">
                @if($icon ?? false)
                    <div class="w-10 h-10 bg-{{ $iconColor ?? 'blue' }}-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="{{ $icon }} text-white"></i>
                    </div>
                @endif
                {{ $title }}
            </h3>
            <button onclick="{{ $closeFunction ?? 'closeModal(\'' . $id . '\')' }}" 
                    class="text-gray-400 hover:text-gray-300 p-2 hover:bg-gray-700 rounded-lg">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <div class="space-y-4">
            {{ $slot }}
        </div>
    </div>
</div>

<style>
.modal-backdrop {
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(4px);
}

.modal-content {
    background: #1f2937;
    border: 1px solid #374151;
    border-radius: 16px;
}
</style>