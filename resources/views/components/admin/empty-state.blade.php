<tr>
    <td colspan="{{ $colspan }}" class="px-6 py-16 text-center">
        <div class="flex flex-col items-center">
            <div class="w-20 h-20 bg-gray-700 rounded-full flex items-center justify-center mb-6">
                <i class="{{ $icon }} text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-white mb-2">{{ $title }}</h3>
            <p class="text-gray-400 text-sm mb-6">{{ $description }}</p>
            @if($action ?? false)
                {{ $action }}
            @endif
        </div>
    </td>
</tr>