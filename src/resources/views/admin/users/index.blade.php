<x-app-layout> 
    <x-container>
        <x-header class="mb-12 px-6 sm:px-0">
            <div class="sm:flex">
                <x-heading class="sm:mr-4">Users</x-heading>
            </div>
        </x-header>

        <div class="hidden sm:block p-6">
            <x-table.root > 
                <x-slot name="header"> 
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Email</x-table.th>
                    <x-table.th>Role</x-table.th>
                    <x-table.th></x-table.th>
                </x-slot>
                @foreach ($users as $user)
                    <tr>
                        <x-table.td> 
                            <x-slot name="value">
                                    {{ $user->name }}
                            </x-slot>
                        </x-table.td>
                        <x-table.td> 
                            <x-slot name="value">
                                    {{ $user->email }}
                            </x-slot>
                        </x-table.td>
                        <x-table.td> 
                            <x-slot name="value">
                                    {{ $user->role }}
                            </x-slot>
                        </x-table.td>
                        <x-table.td> 
                            <x-slot name="value">
                                <a href="{{ route('user.edit', $user) }}" class="text-gray-800 hover:text-indigo-900">View</a>
                            </x-slot>
                        </x-table.td>
                    </tr>
                @endforeach
            </x-table.table>
        </div>
    </x-container>
</x-app-layout>