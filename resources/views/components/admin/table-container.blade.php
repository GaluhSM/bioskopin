<div class="table-container">
    <x-admin.table-header 
        :title="$title"
        :icon="$icon"
        :iconColor="$iconColor ?? 'blue'"
        :viewAllUrl="$viewAllUrl ?? null"
        :viewAllText="$viewAllText ?? null">
        <x-slot name="action">
            {{ $action ?? '' }}
        </x-slot>
    </x-admin.table-header>
    
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead class="table-head">
                {{ $thead }}
            </thead>
            <tbody class="table-body">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>

<style>
.table-container {
    background: #1f2937;
    border: 1px solid #374151;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.table {
    min-width: 100%;
    border-collapse: collapse;
}

.table-head {
    background: #0f172a;
}

.table-head th {
    padding: 12px 16px;
    text-align: left;
    font-size: 11px;
    font-weight: 600;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 1px solid #374151;
}

.table-body tr {
    background: #1f2937;
    border-bottom: 1px solid #2d3748;
    transition: background-color 0.2s ease;
}

.table-body tr:hover {
    background: #243447;
}

.table td {
    padding: 16px;
    font-size: 14px;
    color: #e5e7eb;
    vertical-align: middle;
}
</style>