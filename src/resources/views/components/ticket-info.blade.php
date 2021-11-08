@props(['ticket' => [], 'readonly' => false])

@if ($readonly)
    <x-panel>
        <h3 class="text-lg font-medium leading-6 text-gray-900">Infomation</h3>
        <hr class="my-4">
        <div class="flex justify-between mt-4">
            <p>Type</p>
            <p class="font-semibold">Feature </p>
        </div>
        <hr class="my-4">
        <div class="flex justify-between mt-4">
            <p>Status</p>
            <p class="font-semibold">In progress</p>
        </div>
        <hr class="my-4">
        <div class="flex justify-between mt-4">
            <p>Priority</p>
            <p class="font-semibold">High</p>
        </div>
        <hr class="my-4">
        <div class="flex justify-between mt-4">
            <p>Developer</p>
            <p class="font-semibold">James May </p>
        </div>
        <hr class="my-4">
        <div class="flex justify-between mt-4">
            <p>Target Data</p>
            <p class="font-semibold">20 Feb, 2021</p>
        </div>
    </x-panel>
@else    
    <x-panel>
        <h3 class="text-lg font-medium leading-6 text-gray-900">Infomation</h3>
        <hr class="my-4">
        <div class="mt-4">
            <x-label>Type</x-label>
            <x-ticket-type-select :selected="$ticket->ticket_type_id"/>
        </div>
        <div class="mt-4">
            <x-label>Status</x-label>
            <x-ticket-status-select :selected="$ticket->status_id"/>
        </div>
        <div class="mt-4">
            <x-label>Priority</x-label>
            <x-ticket-priority-select :selected="$ticket->priority_id"/>
        </div>
        <div class="mt-4">
            <x-label>Developer</x-label>
            <x-developer-select :selected="$ticket->owner_id"/>
        </div>
        <div class="mt-4">
            <x-label>Target Date</x-label>
            <x-input id="target_date" 
                    type="date"
                    name="target_date"
                    value="{{ old('target_date', $ticket->target_date) }}"
                    class="mt-1 w-full"
            />
        </div>
    </x-panel>
@endif
