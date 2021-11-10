<x-app-layout> 
    <x-container>

        @if ($ticket->completed())
            <x-alert-success>
                <x-slot name="title">Completed!</x-slot>
                This ticket has been completed
            </x-alert-success>
        @else
            @if ($ticket->rejected())
                <div class="mb-8">
                    <x-alert-danger>
                        <x-slot name="title">Rejected!</x-slot>
                        this ticket has been rejected.
                    </x-alert-danger>
                </div>
                
            @endif

            @if (is_null($ticket->accepted))
                <div class="grid grid-cols-3 gap-6 mb-16">
                    <div class="col-span-2">
                        <x-alert-warning>
                            <x-slot name="title">Pending</x-slot>
                            this ticket is waiting to be accepted.
                        </x-alert-warning>
                    </div>
                    <div class="col-span-1">
                        @can('manage-ticket')
                            <div class="flex flex-col space-y-2">
                                <form method="POST" action="{{ route('ticket.reject', $ticket) }}">
                                    @csrf
                                    <x-button class=" w-full bg-red-900 justify-center">reject</x-button>
                                </form>
                                <form method="POST" action="{{ route('ticket.accept', $ticket) }}">
                                    @csrf
                                    <x-button class="w-full justify-center">accept</x-button>
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>
            @endif 

            @if ($ticket->approved())
                <div class="grid grid-cols-3 gap-6 mb-16">
                    <div class="col-span-2">
                        <x-alert-warning>
                            <x-slot name="title">Ready for completion</x-slot>
                            this ticket is ready to be completed.
                        </x-alert-warning>
                    </div>
                    <div class="col-span-1">
                        <div class="flex flex-col justify-center h-full">
                            @can('manage-ticket')                            
                                <form method="POST" action="{{ Route('ticket.complete', $ticket) }}">
                                    @csrf
                                    <x-button class="w-full justify-center">complete</x-button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>    
            @endif
        @endif
       

        <form method="POST" action="{{ route('tickets.update', $ticket) }}">
            @csrf
            @method('PUT')
            <x-header-section>
                <x-slot name="heading">
                    {{ $ticket->title }}
                </x-slot>
                <x-slot name="subHeading">
                    {{ 'Created on ' . $ticket->created_at->toFormattedDateString() }}
                </x-slot>

                @unless ($ticket->completed())                        
                    @can('update', $ticket)
                        <x-button class="sm:mt-0 sm:w-auto px-10 w-full justify-center mt-4">update</x-button> 
                    @endcan
                @endunless

            </x-header-section>

            <div class="grid sm:grid-cols-3 sm:gap-6 sm:mt-6 mt-12">
                <div class="col-span-1 sm:col-span-2">
                    <x-panel class="h-full">
                        <x-form-group>
                            <x-slot name="heading">Title</x-slot>
                            <x-slot name="description">
                                This information will be displayed publicly so be careful what you share.
                            </x-slot>
                            <x-input id="title" class="block mt-2 w-full"
                                    type="text"
                                    name="title"
                                    value="{{ old('title', $ticket->title) }}"
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
                                name="description" rows="7" 
                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2 block w-full sm:text-sm border border-gray-300 rounded-md" 
                            >{{ old('description', $ticket->description) }}</textarea>
                        </x-form-group>
                    </x-panel>
                </div>
                <div class="mt-4 sm:mt-0 col-span-1">
                    @can('manage-ticket')
                        <x-ticket-info :ticket="$ticket"/>
                    @else 
                        <x-ticket-info :readonly="true" :ticket="$ticket"/>
                    @endcan
                </div>
            </div>
        </form>

        @unless (is_null($ticket->accepted) || $ticket->rejected())            
            <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-6 sm:mt-6 mt-12">
                <div class="col-span-1 sm:col-span-2">
                    <x-panel>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Comments</h3>
                        <hr class="my-4">
                        <div class="mb-8 space-y-6">
                            @foreach ($ticket->comments as $comment)
                                <x-comment :comment="$comment"/>
                            @endforeach
                        </div>

                        <div class="-mb-6 -mx-6 bg-gray-50 text-right">
                            <div class="px-6 py-6">
                                @unless ($ticket->completed())                                    
                                    <form method="POST" action="{{ route('ticket.comments', $ticket) }}">
                                        @csrf
                                        @error('body')
                                            <span class="text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                        <textarea id="comment" name="body" rows="5" class="inline-flex  shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2 w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Add your comment here" required></textarea>
                                        <x-button class="mt-2">Comment</x-button>
                                    </form>
                                @endunless
                            </div>
                        </div>
                    </x-panel>
                </div>
                <div class="mt-4 sm:mt-0 col-span-1">
                    <x-panel>
                        @unless ($ticket->completed())                                    
                            <form method="POST" action="{{ route('ticket.documents', $ticket) }}" enctype="multipart/form-data">
                                @csrf
                                <x-ticket-document-upload/>
                            </form>
                        @endunless
                        
                        <x-ticket-documents :documents="$ticket->documents"/>  
                    </x-panel>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-6 sm:mt-24 mt-12">
                <div class="col-span-1 sm:col-span-2">
                    <div class="flex justify-between  items-center">
                        <div class="flex">
                            <div class="flex flex-col">
                                <x-heading>Sub Tasks</x-heading>
                                <p class="ml6 mt-1 text-sm text-gray-400">add some sub tasks </p>
                            </div>
                        </div>
                        <div>
                            @can('manage-task')
                                @unless ($ticket->completed())                                    
                                    <a href="{{ route('ticket.tasks.create', $ticket) }}" class="px-10 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Add</a>
                                @endunless
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="col-span-1 sm:col-span-2">
                    <div class="mt-8 sm:mt-0 sm:p-6">
                        <x-tasks-table :tasks="$ticket->tasks"/>     
                    </div>                     
                </div>

                <div class="col-span-1">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-6 sm:mt-16 mt-12">
                <div class="col-span-1 sm:col-span-2">
                    <div class="flex justify-between  items-center">
                        <div class="flex">
                            <div class="flex flex-col">
                                <x-heading>Approve Ticket</x-heading>
                                <p class="ml6 mt-1 text-sm text-gray-400">add some approvers </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-1 sm:col-span-2">
                    @unless ($ticket->completed())                                    
                        <form method="POST" action="{{ route('ticket.approvals', $ticket) }}">
                            @csrf
                            <x-add-ticket-approver />
                        </form>   
                    @endunless
                </div>
                <div class="col-span-1 sm:col-span-2">
                    <div class="mt-8 sm:mt-0 sm:p-6">
                        <x-ticket-approvers :approvers="$ticket->approvers"/>   
                    </div>
                            
                </div>
           
                <div class="col-span-1">
                </div>
            </div>
        @endunless

    </x-container>
</x-app-layout>