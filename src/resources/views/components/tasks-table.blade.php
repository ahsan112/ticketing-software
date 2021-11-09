@props(['tasks'])

<x-table.root > 
    <x-slot name="header"> 
        <x-table.th>Title</x-table.th>
        <x-table.th>Assignee</x-table.th>
        <x-table.th>Status</x-table.th>
        <x-table.th>Target Date</x-table.th>
        <x-table.th></x-table.th>
    </x-slot>
    @foreach ($tasks as $task)
        <x-tasks-table-row :task="$task" />
    @endforeach
</x-table.root>