@props(['activities'])

<x-panel>
    <div class="w-full flex items-center justify-between mb-8">
        <p class="text-gray-800 dark:text-white text-xl font-normal">
            Activity
        </p>
        <a href="#" class="flex items-center text-sm hover:text-gray-600 dark:text-gray-50 dark:hover:text-white text-gray-300 border-0 focus:outline-none">
            VIEW ALL
        </a>
    </div>
    @foreach ($activities as $activity)
        <x-activity-item :activity="$activity"/>
    @endforeach
</x-panel>

