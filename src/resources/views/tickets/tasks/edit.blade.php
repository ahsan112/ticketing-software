<x-app-layout>
    <x-container>

        <form method="POST" action="{{ route('ticket.tasks.update', $task) }}">
            @csrf
            @method('PUT')
            <x-header-section>
                <x-slot name="heading">
                    {{ $task->title }}
                </x-slot>
                <x-slot name="subHeading">
                    {{ 'Created on ' . $task->created_at->toFormattedDateString() }}
                </x-slot>
            </x-header-section>
            
            <div class="grid sm:grid-cols-3 sm:gap-6 sm:mt-6 mt-12">
                <div class="col-span-1 sm:col-span-2">
                    <x-panel>
                        <x-form-group>
                            <x-slot name="heading">Title</x-slot>
                            <x-slot name="description">
                                This information will be displayed publicly so be careful what you share.
                            </x-slot>
                            <x-input id="title" class="block mt-2 w-full"
                                    type="text"
                                    name="title"
                                    value="{{ old('title', $task->title) }}"
                                    required 
                            />
                        </x-form-group>
                        <x-form-group class="mt-12">
                            <x-slot name="heading">Description</x-slot>
                            <x-slot name="description">
                                This information will be displayed publicly so be careful what you share.
                            </x-slot>
                            <textarea 
                                id="description" 
                                name="description" 
                                rows="7" 
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2 block w-full sm:text-sm border border-gray-300 rounded-md" 
                            >{{ old('description', $task->description) }}</textarea>
                        </x-form-group>
                    </x-panel>
                </div>
                <div class="mt-4 sm:mt-0 col-span-1">
                    <x-panel>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Infomation</h3>
                        <hr class="my-4">
                        <div class="mt-4">
                            <x-label>Target Date</x-label>
                            <x-input value="{{ $task->target_date->format('Y-m-d') }}" name="target_date" class="w-full mt-1" type="date"/>
                        </div>
                        <div class="mt-4">
                            <x-label>User</x-label>
                            <x-user-select :selected="$task->owner_id"/>
                        </div>
                    </x-panel>
                </div>
            </div>
        </form>

        
    </x-container>
</x-app-layout>
