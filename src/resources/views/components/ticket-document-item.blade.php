@props(['document'])

{{-- <tr>
    <x-table.td> 
        <x-slot name="value">
            <div class="text-sm text-gray-900">{{ $document->title }}</div>
        </x-slot>
    </x-table.td>
    <x-table.td> 
        <x-slot name="value">
            <div class="text-sm text-gray-900">{{ $document->createdBy->name }}</div>
            <div class="text-sm text-gray-500"> <time> {{ $document->created_at->diffForHumans() }} </time> </div>
        </x-slot>
    </x-table.td>
    <x-table.td> 
        <x-slot name="value">
            <a href="{{ route('ticket.document.download', $document) }}" class="text-indigo-600 hover:text-indigo-900">download</a>
        </x-slot>
    </x-table.td>
</tr> --}}

<tr>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm text-gray-900">{{ $document->title }}</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-900">{{ $document->createdBy->name }}</div>
        <div class="text-sm text-gray-500"> <time> {{ $document->created_at->diffForHumans() }} </time> </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
      <a href="{{ route('ticket.document.download', $document) }}" class="text-indigo-600 hover:text-indigo-900">download</a>
    </td>
  </tr>