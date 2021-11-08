@props(['ticket'])

<tr>
    <x-table.td> 
        <x-slot name="value">
            <a href="{{ route('tickets.show', $ticket) }}" class="">{{ $ticket->title }}</a>
        </x-slot>
    </x-table.td>
    
    <x-table.td> 
        <x-slot name="value">
            {{ '#'.$ticket->id }}
        </x-slot>
    </x-table.td>

    <x-table.td> 
        <x-slot name="value">
            {{ $ticket->createdBy->name }}
        </x-slot>
    </x-table.td>

    <x-table.td> 
        <x-slot name="value">
            {{ $ticket->department->name ?? 'Not Set' }}
        </x-slot>
    </x-table.td>

    <x-table.td> 
        <x-slot name="value">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded {{ $ticket->priority?->name == 'urgent' ? 'bg-red-100 text-red-900' : 'bg-green-100 text-green-800' }}  ">
                {{ $ticket->priority->name ?? 'Not set' }}
            </span>
        </x-slot>
    </x-table.td>

    <x-table.td> 
        <x-slot name="value">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded bg-green-100 text-green-800">
                {{ $ticket->status->name ?? 'Not set' }}
            </span>
        </x-slot>
    </x-table.td>

    <x-table.td> 
        <x-slot name="value">
            {{ $ticket->target_date?->diffForHummans() ?? '20 Feb, 2021' }}
        </x-slot>
    </x-table.td>

    <x-table.td> 
        <x-slot name="value">
            <a href="{{ route('tickets.show', $ticket) }}" class="text-gray-800 hover:text-indigo-900">View</a>
        </x-slot>
    </x-table.td>
</tr>