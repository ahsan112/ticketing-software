@props(['activity'])

<div class="flex items-start mb-6 rounded justify-between">
    @if ($activity->description == 'uploaded')
        <x-icons.document-icon />
    @else 
        <x-icons.change-icon />
    @endif
    <div class="flex items-center w-full justify-between">
        <div class="flex text-sm flex-col w-full ml-2 items-start justify-between">
            <p class="text-gray-700 dark:text-white">
                <span class="font-bold mr-1">
                    {{ $activity->user->name }}
                </span>

                @if ($activity->subject)
                    {{ $activity->description . ' ' . $activity->subject->title }}
                @endif
                
                @isset($activity->changes)
                    @if (count($activity->changes['after']) == 1)
                        updated the {{ key($activity->changes['after']) }} of the ticket
                    @else
                        updated the ticket
                    @endif
                @endisset
            </p>
            <p class="text-gray-300">
                {{ $activity->created_at->format('M d - G:m:s') }}
            </p>
        </div>
    </div>
</div>