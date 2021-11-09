@props(['documents'])

<x-table.root > 
    <x-slot name="header"> 
        <x-table.th>Title</x-table.th>
        <x-table.th>Uploaded By</x-table.th>
        <x-table.th></x-table.th>
    </x-slot>

    @foreach ($documents as $document)
        <x-ticket-document-item :document="$document" />
    @endforeach
</x-table.root>