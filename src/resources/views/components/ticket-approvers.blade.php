@props(['approvers'])

<x-table.root > 
    <x-slot name="header"> 
        <x-table.th>Approver</x-table.th>
        <x-table.th>Status</x-table.th>
        <x-table.th></x-table.th>
    </x-slot>
    
    @foreach ($approvers as $approver)
        <x-ticket-approver-row :approver="$approver"/>
    @endforeach

</x-table.root> 