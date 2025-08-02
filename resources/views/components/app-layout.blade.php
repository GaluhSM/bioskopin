<!DOCTYPE html>
<html lang="en">
<x-layout.head :title="$title" :styles="$styles ?? ''" />
<x-layout.body>
    <x-navigation />
    
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <x-footer />

    {{ $scripts ?? '' }}
</x-layout.body>
</html>