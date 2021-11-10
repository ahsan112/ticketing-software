<x-app-layout> 
    <x-container>
        <x-header class="mb-12 px-6 sm:px-0">
            <div class="sm:flex">
                <x-heading class="sm:mr-4">My Tasks</x-heading>
            </div>
        </x-header>

        {{-- <div class="sm:hidden px-6 space-y-4 mt-4"> 
            @foreach ($tickets as $ticket)
                <x-tickets-card  :ticket="$ticket"/>
            @endforeach                  
        </div> --}}
        <div class="hidden sm:block p-6">
            <x-tasks-table :tasks="$tasks"/>     
        </div>
    </x-container>
</x-app-layout>