<x-app-layout>
    <x-container>
        <div>
            <x-split-grid>
                <x-slot name="left">
                    <x-heading>New Task</x-heading>
                    <p class="mt-1 text-sm text-gray-600">
                        This information will be displayed publicly so be careful what you share.
                    </p>
                </x-slot>
                <x-slot name="right">
                    <form action="{{ route('ticket.tasks.store', $ticket) }}" method="POST">
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
                                <x-form-group class="sm:col-span-3">
                                    <x-slot name="heading">Description</x-slot>
                                    <x-slot name="description">
                                        This information will be displayed publicly so be careful what you share.
                                    </x-slot>
                                    <textarea id="description" name="description" rows="5" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="you@example.com"></textarea>
                                </x-form-group>
                                <x-form-group>
                                    <x-slot name="heading">Target Date</x-slot>
                                    <x-slot name="description">
                                        This information will be displayed publicly so be careful what you share.
                                    </x-slot>
                                    <x-input id="target_date" class="block mt-1 w-full"
                                            type="date"
                                            name="target_date"
                                            required 
                                    />
                                </x-form-group>
                                <x-form-group>
                                    <x-slot name="heading">User</x-slot>
                                    <x-slot name="description">
                                        This information will be displayed publicly so be careful what you share.
                                    </x-slot>
                                    <x-select name="owner_id" :items="$users" />
                                </x-form-group>
                                
                                
                            </div>
                            <div class="text-right mt-8">
                                <x-button>Add Task</x-button>
                              </div>
                        </x-panel>
                    </form>
                </x-slot>
            </x-split-grid>
        </div>
    </x-container>
</x-app-layout>