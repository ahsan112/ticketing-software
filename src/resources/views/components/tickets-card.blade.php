@props(['ticket'])

<x-panel>
    <div class="text-sm font-medium text-gray-900">{{ $ticket->title . '- ' . $ticket->id }}</div>
    <hr class="mt-4">
    <div class="mt-4 space-y-4">
        <div class="flex items-center">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <div class="text-sm ml-4">{{ $ticket->owner->name ?? 'James May' }}</div>
        </div>
        <div class="flex items-center">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="text-sm ml-4">20 Feb, 2021</div>
        </div>
        <div class="flex items-center">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
            </svg>
            <div class="text-sm ml-4">Sales</div>
        </div>
    </div>
    <div class="mt-4">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded bg-red-100 text-red-900">
            High
        </span>
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded bg-green-100 text-green-800">
            In progress
        </span>
    </div>
</x-panel>