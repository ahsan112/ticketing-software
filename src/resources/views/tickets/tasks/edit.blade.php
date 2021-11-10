<x-app-layout>
    <x-container>

        @if ($task->completed())
            <x-alert-success>
                <x-slot name="title">Completed!</x-slot>
                This Task has been completed
            </x-alert-success>
        @else
            @can('complete', $task)            
                <div class="grid grid-cols-3 gap-6 mb-16">
                    <div class="col-span-2">
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                            <p class="font-bold">Task needs completing </p>
                            <p>Please complete this task as soon as possible. <br> The deadline is {{ $task->target_date->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="flex flex-col justify-center h-full">
                            <form method="POST" action="{{ Route('ticket.tasks.complete', $task) }}">
                                @csrf
                                <x-button class="w-full justify-center">complete</x-button>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan
        @endif
       

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

                @unless ($task->completed())
                    @can('manage-task')
                        <x-button class="sm:mt-0 sm:w-auto px-10 w-full justify-center mt-4">update</x-button> 
                    @endcan
                @endunless
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

        <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-6 sm:mt-6 mt-12">
            <div class="col-span-1 sm:col-span-2">
                <form method="POST" action="{{ route('ticket.task.comments', $task) }}">
                    @csrf
                    @unless ($task->completed())
                        <x-comments-panel :comments="$task->comments"/>
                    @else 
                        <x-comments-panel :add="false" :comments="$task->comments"/>
                    @endunless
                </form>
            </div>
        </div>
        
    </x-container>
</x-app-layout>
