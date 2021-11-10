@props(['readonly' => false])

<x-header>
    <div class="sm:flex">
        {{-- <x-heading class="sm:mr-4">#131</x-heading> --}}
        <div class="flex flex-col">
            <x-heading>{{ $heading }}</x-heading>
            <p class="ml6 mt-1 text-sm text-gray-400">{{ $subHeading ?? '' }}</p>
        </div>
    </div>
    @unless ($readonly)
        {{ $slot }}
        {{-- <x-button class="sm:mt-0 sm:w-auto px-10 w-full justify-center mt-4">update</x-button>  --}}
    @endunless
</x-header>