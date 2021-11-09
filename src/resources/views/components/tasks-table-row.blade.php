@props(['task'])

<tr>
    <x-table.td> 
        <x-slot name="value">
            {{ $task->title }}
        </x-slot>
    </x-table.td>
    <x-table.td> 
        <x-slot name="value">
            {{ $task->owner->name }}
        </x-slot>
    </x-table.td>
    <x-table.td> 
        <x-slot name="value">
            @if ($task->completed())
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded bg-green-100 text-green-800">
                    completed  - {{ $task->completed_at }}
                </span>
            @else
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded bg-red-100 text-red-900">
                    Open
                </span>
            @endif
        </x-slot>
    </x-table.td>
    <x-table.td> 
        <x-slot name="value">
            {{ $task->target_date->diffForHumans() }}
        </x-slot>
    </x-table.td>
    <x-table.td> 
        <x-slot name="value">
            <a href="#" class="text-gray-900">view</a>
        </x-slot>
    </x-table.td>
</tr>