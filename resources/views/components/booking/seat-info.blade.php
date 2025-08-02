<x-ui.info-section title="Kursi yang dipilih">
    <div class="flex flex-wrap gap-2">
        @foreach($booking->seats as $seat)
            <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm">
                {{ $seat->row }}{{ $seat->number }}
            </span>
        @endforeach
    </div>
</x-ui.info-section>