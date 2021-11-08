@props(['route'])
<form class="flex py-4 sm:py-0" method="POST" action="{{ $route }}">
    @csrf
    <x-input name="search" class="mr-2 px-2 py-2 w-80" />

    <x-button class="hidden sm:block">search</x-button>
    <x-button class="sm:hidden">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </x-button>
</form>
