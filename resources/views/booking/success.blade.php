<x-app-layout title="Booking Berhasil">
    <div class="min-h-screen bg-gray-900 py-12">
        <div class="max-w-4xl mx-auto px-4">
            <x-booking.success-header />
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <x-booking.success-details :booking="$booking" />
                <x-booking.success-qr :booking="$booking" :qrCode="$qrCode" />
            </div>

            <x-booking.success-notice />
        </div>
    </div>

    <x-slot name="scripts">
        <x-booking.success-scripts :booking="$booking" />
    </x-slot>
</x-app-layout>