@props(['dates', 'activities'])

<x-panel>
    <div class="w-full flex items-center justify-between mb-8">
        <p class="text-gray-800 dark:text-white text-xl font-normal">
            Activity
        </p>
    </div>
    @foreach ($activities as $date => $activity)
        @if ($activity->isNotEmpty())
            <div>{{ $date }}</div>
            @foreach ($activity as $item)
                <x-activity-item :activity="$item"/>
            @endforeach
        @endif
    @endforeach
</x-panel>