<x-app-layout> 
    <x-container>
        <x-header class="mb-12 px-6 sm:px-0">
            <div class="sm:flex">
                <x-heading class="sm:mr-4">Tickets</x-heading>
            </div>
            <x-filters :view="$view" :user="$user"/>
            <div>
                <x-search :route="'test'" />
            </div>
        </x-header>

        <div class="sm:hidden px-6 space-y-4 mt-4"> 
            @foreach ($tickets as $ticket)
                <x-tickets-card  :ticket="$ticket"/>
            @endforeach                  
        </div>
        <div class="hidden sm:block p-6">
            <x-table.root > 
                <x-slot name="header"> 
                    <x-table.th>Title</x-table.th>
                    <x-table.th>Number</x-table.th>
                    <x-table.th>Raised By</x-table.th>
                    <x-table.th>Department</x-table.th>
                    <x-table.th>Priority</x-table.th>
                    <x-table.th>Status</x-table.th>
                    <x-table.th>Target Date</x-table.th>
                    <x-table.th></x-table.th>
                </x-slot>
                @foreach ($tickets as $ticket)
                    <x-tickets-table-row :ticket="$ticket" />
                @endforeach
            </x-table.table>
        </div>
    </x-container>
</x-app-layout>