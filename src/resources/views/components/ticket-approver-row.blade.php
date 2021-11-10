@props(['approver'])

<tr>
    <x-table.td> 
        <x-slot name="value">
            {{ $approver->owner->name }}
        </x-slot>
    </x-table.td>
    @if ($approver->approved())
        <x-table.td> 
            <x-slot name="value">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded bg-green-100 text-green-900">
                    Approved
                </span>
            </x-slot>
        </x-table.td>
        <x-table.td> 
            <x-slot name="value">
            </x-slot>
        </x-table.td>
    @else
        <x-table.td> 
            <x-slot name="value">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded bg-red-100 text-red-900">
                    Waiting Approval
                </span>
            </x-slot>
        </x-table.td>
        <x-table.td> 
            <x-slot name="value">
                @can('approve', $approver)
                <form method="POST" action="{{ route('ticket.approver.approve', $approver) }}">
                    @csrf    
                    <x-button>Approve</x-button>
                </form>
                @endcan
            </x-slot>
        </x-table.td>
    @endif
</tr>