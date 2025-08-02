<x-app-layout title="Booking Tiket - {{ $schedule->movie->title }}">
    <div class="bg-gray-900 min-h-screen py-8">
        <div class="max-w-6xl mx-auto px-4">
            <x-booking.header :schedule="$schedule" />

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <x-booking.seat-map :schedule="$schedule" :availableSeats="$availableSeats" />
                
                <x-booking.booking-form :schedule="$schedule" />
            </div>
        </div>
    </div>

    @if($errors->any())
        <x-notification 
            type="error" 
            message="{{ $errors->first() }}" 
            id="error-message" />
    @endif

    <x-slot name="scripts">
        <x-booking.scripts :schedule="$schedule" />
    </x-slot>

    <x-slot name="styles">
        <x-booking.styles />
    </x-slot>
</x-app-layout>