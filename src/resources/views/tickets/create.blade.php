<x-app-layout>
    <x-container>
        <div>
            <x-split-grid>
                <x-slot name="left">
                    <x-heading>New Ticket</x-heading>
                    <p class="mt-1 text-sm text-gray-600">
                        This information will be displayed publicly so be careful what you share.
                    </p>
                </x-slot>
                <x-slot name="right">
                    <form method="POST" action="{{ route('tickets.store') }}">
                        @csrf
                        <x-panel >
                            <div class="grid grid-cols-3 gap-6 space-y-6">
                                <x-form-group>
                                    <x-slot name="heading">Title</x-slot>
                                    <x-slot name="description">
                                        This information will be displayed publicly so be careful what you share.
                                    </x-slot>
                                    <x-input id="title" class="block mt-1 w-full"
                                            type="text"
                                            name="title"
                                            required 
                                    />
                                </x-form-group>
                                <x-form-group>
                                    <x-slot name="heading">Type</x-slot>
                                    <x-slot name="description">
                                        This information will be displayed publicly so be careful what you share.
                                    </x-slot>
                                    <x-ticket-type-select />
                                </x-form-group>
                                <x-form-group>
                                    <x-slot name="heading">Department</x-slot>
                                    <x-slot name="description">
                                        This information will be displayed publicly so be careful what you share.
                                    </x-slot>
                                    <x-department-select />
                                </x-form-group>
                                <x-form-group class="sm:col-span-3">
                                    <x-slot name="heading">Description</x-slot>
                                    <x-slot name="description">
                                        This information will be displayed publicly so be careful what you share.
                                    </x-slot>
                                    <textarea 
                                        rows="5"
                                        name="description" 
                                        id="description" 
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    >{{ old('description') }}</textarea>
                                </x-form-group>                          
                            </div>
                            <div class="text-right mt-8">
                                <x-button>create</x-button>
                              </div>
                        </x-panel>
                    </form>
                </x-slot>
            </x-split-grid>
        </div>
    </x-container>
</x-app-layout>