@if($movie->producer || $movie->publisher)
<div class="mb-6">
    @if($movie->producer)
    <p class="text-gray-300 mb-2">
        <span class="font-semibold">Produser:</span> {{ $movie->producer }}
    </p>
    @endif
    @if($movie->publisher)
    <p class="text-gray-300">
        <span class="font-semibold">Publisher:</span> {{ $movie->publisher }}
    </p>
    @endif
</div>
@endif