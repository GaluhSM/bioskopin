<div class="flex flex-wrap items-center text-gray-300 mb-6 space-x-6">
    <div class="flex items-center">
        <i class="fas fa-clock mr-2"></i>
        <span>{{ $movie->duration_minutes }} menit</span>
    </div>
    <div class="flex items-center">
        <i class="fas fa-calendar mr-2"></i>
        <span>{{ \Carbon\Carbon::parse($movie->release_date)->format('M Y') }}</span>
    </div>
    <div class="flex items-center">
        <i class="fas fa-users mr-2"></i>
        <span>{{ $movie->audience_rating }}</span>
    </div>
</div>