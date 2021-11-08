<div {{ $attributes->merge(['class' => 'col-span-3 sm:col-span-2']) }}>
    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $heading }}</h3>
    <p class="mt-2 text-sm text-gray-600">
        {{ $description }}
    </p>
    <div class="mt-1 flex rounded-md shadow-sm">
        {{ $slot }}
    </div>
</div>